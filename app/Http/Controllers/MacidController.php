<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Macid;

class MacidController extends Controller
{
    public function updateMerchantId(Request $request){
        $validator = Validator::make($request->all(), [
            'macid' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $macid = Macid::where('macid', $request->macid)->first();
        if($macid){
            $macid->merchant_id = $request->merchant_id;
            $macid->save();
            return response()->json(['success' => 'success', 'baseCreds' => $macid], 200);
        }
        return response()->json(['error' => 'MacId Not Found'], 400);
    }
    public function setMacId(Request $request){
        $validator = Validator::make($request->all(), [
            'macid' => 'required|string',
            'merchant_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $macid = new Macid;
        $macid->macid = $request->macid;
        $macid->merchant_id = $request->merchant_id;
        $macid->save();
        return response()->json(['success' => 'success', 'baseCreds' => $macid], 200);
    }
    public function getMacId(Request $request){
        $validator = Validator::make($request->all(), [
            'macid' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $macid = Macid::where('macid', $request->macid)->first();
        if($macid){
            return response()->json(['success' => 'success', 'baseCred' => $macid], 200);
        }
        return response()->json(['error' => 'No Record Found'], 400);
    }
}
