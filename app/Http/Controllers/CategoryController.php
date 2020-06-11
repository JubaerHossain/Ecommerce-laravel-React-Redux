<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Storage;
use App\Message;
use Image;
use File;
use Auth;
use DB;
class CategoryController extends Controller
{
	public function proCategory(){
		$d2 = \Request::ip();     
		$merchant = Storage::select('storage')->where('token', $d2)->first();
	   if($merchant){
			$categories = DB::table('categories')
				->join('products', 'categories.id', '=', 'products.category_id')->distinct()
				->select('categories.id','categories.name','categories.depth','categories.slug','categories.parent','categories.string')
				->where('products.merchant_id','=', $merchant->storage)
				->get();
				return response()->json($categories, 200);
		}
		else {
			$categories = DB::table('categories')
				->join('products', 'categories.id', '=', 'products.category_id')->distinct()
				->select('categories.id','categories.name','categories.depth','categories.slug','categories.parent','categories.string')
				->where('products.merchant_id','=', 8)
				->get();
				return response()->json($categories, 200);
		}
}
	public function apiALLCategory(){		
		$categories = Category::select('id','name', 'slug','parent', 'depth', 'string')->get();
		return response()->json($categories, 200);
	}

    public function adminProductCategory(){
				$categories = Category::all();
				$messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        return view('admin.product-category', compact('categories','messg'));
    }
    public function postAdminProductCategory(Request $r){
		
				$this->validate($r,[
					'name'   =>'required|unique:categories,name',
					'parent' =>'required|string',
					'icon'  =>'sometimes|nullable|string',
				]);
				
				if($r->parent == 0){
					$parent = 0;
					$depth = 0;
					$string = ',';
				}else{
					$parentClass = Category::find($r->parent);
					if($parentClass){
						$parent = $parentClass->id;
						$depth = $parentClass->depth + 1;
						$string = $parentClass->string;				
					}else{
						return redirect()->back()->with('warning', 'No Parent Found');
					}
				}
				if($r->central){
					$r->central = 1;
				}else{
						$r->central = 0;
				}
				$category = new Category;
				$category->name = $r->name;
				$category->slug = str_slug($r->name, '-');
				$category->parent = $parent;
				$category->depth = $depth;
				$category->string = $string;
				$category->icon = $r->icon;
				/* $category->central = $r->central; */
				$category->save();
				$category->string = $category->string.$category->id.',';
				$category->save();
				

		return redirect()->back()->with('success', "Category <strong>$category->name</strong> added successfully!!");
	}
	public function categoryProduct($string){
		$d2 = \Request::ip();      
        $merchant = Storage::select('storage')->where('token', $d2)->first();
        if($merchant){
		$products = Product::where('adstatus', 1)->where('merchant_id', $merchant->storage)->where('string', 'like',  '%' . $string . '%')
                    ->join('variations', function($join){ 
                        $join->on('products.id', '=', 'variations.product_id')
                        ->where('onload', 1);
                    })
                    ->select('products.id','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                    ->get();
		return response()->json($products, 200);
	}
	else {
		$products = Product::where('adstatus', 1)->where('merchant_id',8)->where('string', 'like',  '%' . $string . '%')
                    ->join('variations', function($join){ 
                        $join->on('products.id', '=', 'variations.product_id')
                        ->where('onload', 1);
                    })
                    ->select('products.id','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                    ->get();
		return response()->json($products, 200);
	}
	}
    public function adminEditCategory($id){
		$categories = Category::all();
		$data=Category::findOrFail($id);
		$messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
		return view('admin.category',compact('data','categories','messg'));

	}
	public function postCategoryEdit(Request $r,$id){
		$this->validate($r,[
			'name'   =>'required|unique:categories,name,'.$id,
			'parent' =>'required|string',
			'icon'  =>'sometimes|nullable|string',
		]);
		if($r->parent == 0){
			$parent = 0;
			$depth = 0;
			$string = ',';
		}else{
			$parentClass = Category::find($r->parent);
			if($parentClass){
				$parent = $parentClass->id;
				$depth = $parentClass->depth + 1;
				$string = $parentClass->string;				
			}else{
				return redirect()->back()->with('warning', 'No Parent Found');
			}
		}		
		if($r->central){
			$r->central = 1;
		}else{
				$r->central = 0;
		}
		$data=Category::findOrFail($id);
		$data->name = $r->name;
		$data->slug = str_slug($r->name, '-');
		$data->parent = $parent;
		$data->depth = $depth;
		$data->string = $string;
		$data->icon = $r->icon;
		/* $data->central = $r->central; */
		$data->save();
		$data->string = $data->string.$data->id.',';
		$data->save();
		return redirect()->back()->with('success', "Category <strong>$data->name</strong> edit successfully!!");
	}
}
