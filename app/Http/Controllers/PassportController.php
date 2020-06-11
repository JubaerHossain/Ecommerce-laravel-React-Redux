<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Customer;
use App\Merchant;
use App\User;
use App\Upline;
use App\Storage;
use Auth;
use Illuminate\Http\Request;
use Validator;

class PassportController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|min:2',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $field = 'email';
        if (is_numeric($request->input('email'))) {
            $field = 'phone';
        } elseif (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }
        if (Auth::attempt([$field => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;            
            $user->mac_id=\Request::ip();
            $user->save();
            $data=Storage::firstOrCreate(['user_id' => Auth::user()->id]);        
            $data->storage=8;
            $data->token=\Request::ip();
            $data->user_id=Auth::user()->id;
            $data->save(); 

            return response()->json(['success' => true, 'token' => 'Bearer '.$token, 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|unique:users',
            'role' => 'required|string|max:20',
            'dpid' => 'sometimes|nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = new User;
        $user->name = $request->name;
        $user->mac_id = \Request::ip();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->affiliator = $request->dpid;
        $user->save();
        if ($user->role == 'merchant') {
            $merchant = new Merchant();
            $merchant->user_id = $user->id;
            $merchant->save();

            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->save();
        } else {
            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->save();
        }
        $success['token'] = $user->createToken('secTok')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], 200);
    }
}
