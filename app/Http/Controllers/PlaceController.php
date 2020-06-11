<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\District;

class PlaceController extends Controller
{
    public function apiDivisions(){
        $districts = Division::all();
        return response()->json($districts, 200);
    }
    public function apiDistricts($name){
        $div = Division::where('name', 'LIKE', '%' . $name . '%')->first();
        $district = District::where('division_id', $div->id)->get();
        return response()->json($district, 200);
    }
}
