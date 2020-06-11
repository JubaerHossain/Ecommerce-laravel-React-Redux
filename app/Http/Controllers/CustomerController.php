<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Validator;
use App\Customer;
use App\Upline;
use App\Income;
use App\Withdraw;
use App\User;
use Auth;

class CustomerController extends Controller
{
    public function customerProfile(){
        $customer = Auth::user()->customer;
        return response()->json($customer, 200);
    }
    public function customerUpdateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'division' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'street' => 'sometimes|nullable|string',
            'address' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $customer = Auth::user()->customer;
        $customer->division = $request->division;
        $customer->district = $request->district;
        $customer->city = $request->city;
        $customer->street = $request->street;
        $customer->address = $request->address;
        $customer->save();

        return response()->json($customer, 200);
    }
    public function apiGetAffiliators(){
        if(Auth::user()->dpid){
            $user = User::where('affiliator', Auth::user()->dpid)->with('customer')->get();
            return response()->json($user, 200);
        }
        return response()->json(['error'=> 'DLPID Not Set'], 400);
    }
    public function setUserId(Request $request){
        $validator = Validator::make($request->all(), [
            'dpid' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }
        $dpid = $request->dpid - 100000;
        $hasDlpid = User::where('dpid', $dpid)->first();
        if($hasDlpid){
            return response()->json(['error' => 'DLP ID Exists'], 400);
        }
        if(Auth::user()->dpid){
            return response()->json(['error' => 'There is already a DLP ID.'], 400);
        }
        Auth::user()->dpid = $dpid;
        Auth::user()->affiliator = $dpid;
        if(!in_array('affiliator', explode(',', Auth::user()->role))){
            Auth::user()->role = Auth::user()->role.',affiliator';
        }
        Auth::user()->save();

        $client = new Client(); //GuzzleHttp\Client
        $response = $client->GET('http://dlpbd.com/api/get-upline-all/'.$dpid);
        if($response->getStatusCode() == 200){
            $resp = $response->getBody();
            $obj = json_decode($resp);

            $line = Upline::where('user_id', $dpid)->first();
            if(!$line){
                $upline = new Upline;
                $upline->user_id = $dpid;
                $upline->a = $obj->uplines[0];
                $upline->b = $obj->uplines[1];
                $upline->c = $obj->uplines[2];
                $upline->d = $obj->uplines[3];
                $upline->e = $obj->uplines[4];
                $upline->f = $obj->uplines[5];
                $upline->g = $obj->uplines[6];
                $upline->save();
            }
        }
        return response()->json(Auth::user(), 200);

    }
    public function getDashboard(){
        if(Auth::user()->dpid){
            $income = Income::where('dpid', Auth::user()->dpid)->first();
            if($income){
                $dashboard = [
                    'self' => $income->self,
                    'affiliate' => $income->a,
                    'incentive' => $income->b+$income->c+$income->d+$income->e+$income->f+$income->g,
                    'target' => 2000,
                ];
                return response()->json($dashboard, 200);
            }
            return response()->json(['warning' => 'No Income Found'], 400);
        }
        return response()->json(['warning' => 'DPID Not Set'], 400);
    }
    public function transferBalance(){
        $target = 3000;
        // Check Date
        $income = Income::where('dpid', Auth::user()->dpid)->first();
        if($income){
            $incentive = $income->b+$income->c+$income->d+$income->e+$income->f+$income->g;
            $sd = $income->self + $income->a;
            $per = ($sd * 100)/$target;
            $achivedTot = ($incentive * $per)/100;
            $tot = $achivedTot + $sd;

            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY3NDJhMTZmMmY0ODAwMDUwODU2MmM4ZDVkNTk2YTNhN2VhMDBiYTlmZGQ0Yjk5ODExOTAyODY3MmU0NDNmZjczOWMyZTViOGMyZTFjMjBlIn0.eyJhdWQiOiIzIiwianRpIjoiZjc0MmExNmYyZjQ4MDAwNTA4NTYyYzhkNWQ1OTZhM2E3ZWEwMGJhOWZkZDRiOTk4MTE5MDI4NjcyZTQ0M2ZmNzM5YzJlNWI4YzJlMWMyMGUiLCJpYXQiOjE1NTkxMjEwMjksIm5iZiI6MTU1OTEyMTAyOSwiZXhwIjoxNTkwNzQzNDI5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.T_SDaoGfY6GbgP1zlMF_iPkcrgCs7N2HPR0L0rPRGxk9L5yNYhXkfFvPI_nCAYEJ5mQO4SOoZKvMquVOWcSM2zjonZGvKVZ-fsQXhEscSFB01aA4GSiJ90_zTChr_wP3aRWg8dTHZaEiRg4I6EfOCyDc7kP7HzpReThHhR7flqesm_b24wVVXBwIDOVLGatGqRv8MHSW1PEnlcvN9xOiJ_8itGW5vaBgVGNmnSlZh2AssYRRkmTPp3K7PYiiTm5pe46LgxNcH8HeImAhKZQiLrbAbiDWzUYwo386k0oaslUED-4uiXyd1AnukcUeMORXuz8PYNP0g_Ferv7tNN414s4Bkzu5sUzs1faK26PKupZdRi43nsrm7Y-16i3xT9-ZWntFmJpHPIzKD_axLoJdjYkfwy2-gs584oXQf5MiBWswKbZdbl9z7cgODzJLyH_DTaHf7Mn5ByemRKwCVuplqJ8X6frapRViNVwh5DzJKtXxsN3ZK-fN-0Hq6YlynckaR4epJPDu2S6Ed0K1gSQZH5NjYQMDlOZ1ZL4YF1m0Ljee8ZN9ONprqorcTjvKWzEANtY1ZY9n4In9WbGTwDBCkHlo-BwJEGvdhmZRJ0pGQ3DqvzCqYRGXwXYF631iBCie63HeaNtxWcGPkQIsBkL-Q19JdZA8MoJc5OU59Dvzw2c',
              ];
            $client = new Client([
                'headers' => $headers
            ]);
            $response = $client->POST('http://dlpbd.com/api/set-dlp', [
                'form_params' => [
                    'id' => $income->dpid,
                    'unistag' => $tot,
                ]
            ]);
            $resp = $response->getBody();
            $obj = json_decode($resp);
            if($obj->user_id){
                $withdraw = new Withdraw;
                $withdraw->user_id = $income->dpid;
                $withdraw->target = $target;
                $withdraw->incentive = $incentive;
                $withdraw->snd = $sd;
                $withdraw->achieved = $per;
                $withdraw->approved = $achivedTot;
                $withdraw->save();

                $income->self=0.00;$income->a=0.00;$income->b=0.00;$income->c=0.00;$income->d=0.00;$income->e=0.00;$income->f=0.00;$income->g=0.00;
                $income->save();



                $dashboard = [
                    'self' => $income->self,
                    'affiliate' => $income->a,
                    'incentive' => $income->b+$income->c+$income->d+$income->e+$income->f+$income->g,
                    'target' => 3000,
                ];
                return response()->json($dashboard, 200);
            }
            return response()->json('Something went wrong', 400);
        }
        return redirect()->response(['warning' => 'No Income Foundf'], 400);
    }
    public function getTransfer(){
        $withdraws = Withdraw::where('user_id', Auth::user()->dpid)->get();
        return response()->json($withdraws, 200);
    }
}
