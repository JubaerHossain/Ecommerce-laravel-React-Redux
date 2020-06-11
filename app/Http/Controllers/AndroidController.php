<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Macid;
use App\Merchant;
use Auth;

class AndroidController extends Controller
{
    public function central_product(){
        
        $products = Product::where('adstatus', 1)->where('merchant_id', 8)
                        ->join('variations', function($join){ 
                            $join->on('products.id', '=', 'variations.product_id')
                            ->where('onload', 1);
                        })
                        ->select('products.id','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                        ->orderby('id', 'desc')->take(8)->get();
            return response()->json($products, 200);

    }
    public function apiOfflineMerchants(){
        $merchants = Merchant::where('offline', 1)->get();
        if($merchants){
            return response()->json(['success' => 'success', 'merchants' => $merchants ], 200);
        }
        return response()->json(['error' => 'Error'], 400);
    }
    public function apiALLProduct($macid){
        $merchant = Macid::select('merchant_id')->where('macid', $macid)->first();
        if($merchant){
            $products = Product::where('adstatus', 1)->where('merchant_id', $merchant->merchant_id)
                        ->join('variations', function($join){ 
                            $join->on('products.id', '=', 'variations.product_id')
                            ->where('onload', 1);
                        })
                        ->select('products.id','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                        ->orderby('id', 'desc')->take(8)->get();
            return response()->json($products, 200);
        }
        return response()->json(['warning' => 'No mac Id Found'], 200);
    }
    public function apiSearchProduct($macid, $query){
        $merchant = Macid::select('merchant_id')->where('macid', $macid)->first();
        if($merchant){
            $products = Product::where('adstatus', 1)->where('merchant_id', $merchant->merchant_id)->where('name', 'like', '%'.$query.'%')
                        ->join('variations', function($join){ 
                            $join->on('products.id', '=', 'variations.product_id')
                            ->where('onload', 1);
                        })
                        ->select('products.id','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                        ->orderby('id', 'desc')->take(8)->get();
            return response()->json($products, 200);
        }
        return response()->json(['warning' => 'No mac Id Found'], 200);
    }
    public function getProduct($macid, $slug){
        $merchant = Macid::select('merchant_id')->where('macid', $macid)->first();
        if($merchant){
            $product = Product::where('merchant_id', $merchant->merchant_id)->select('id', 'name', 'merchant_id', 'slug', 'category_id', 'brand', 'images', 'thumbnail', 'views')
                        ->where('slug', 'like', '%'.$slug.'%')
                        ->with('properties:product_id,description,measurement', 'variations:id,product_id,color,size,unit,qty,price,v_price,discount,onload,image')
                        ->first();
            if($product){
                return response()->json($product, 200);
            }
            return response()->json(['error'=>'No Product Found'], 400);
        }
        return response()->json(['warning' => 'No mac Id Found'], 200);
    }
    public function categoryProduct($macid, $string){
        $merchant = Macid::select('merchant_id')->where('macid', $macid)->first();
        if($merchant){
            $products = Product::where('adstatus', 1)->where('merchant_id', $merchant->merchant_id)->where('string', 'like',  '%' . $string . '%')
                        ->join('variations', function($join){ 
                            $join->on('products.id', '=', 'variations.product_id')
                            ->where('onload', 1);
                        })
                        ->select('products.id','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                        ->get();
            return response()->json($products, 200);
        }
        return response()->json(['warning' => 'No mac Id Found'], 200);
	}
}
