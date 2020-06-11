<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Variation;
use App\Color;
use App\ColorCode;
use App\Property;
use App\Weight;
use App\Message;
use App\Brand;
use App\Merchant;
use App\Storage;
use App\User;
use Image;
use File;
use Auth;
use Cache;
use Session;
class ProductController extends Controller
{  
    
    public function allstorage(){
        $storages = Auth::user()->storages;
        $storages= Merchant::where('id',$storages->storage)->select('id as storages_id','name as storage_name')->first();        
        return response()->json($storages, 200);
    }  
    public function delete_storage(){
        $storages = Auth::user()->storages->delete();
        return response()->json($storages, 200);
    }
    public function storage(Request $request){       
        $validator = \Validator::make($request->all(), [
            'storage' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $data=Storage::firstOrCreate(['user_id' => Auth::user()->id]);
        
        $data->storage=$request->storage;
        $user = Auth::user();
        $data->token=\Request::ip();
        $data->user_id=Auth::user()->id;
        $data->save();       
        return response()->json($data, 200);
    }

    public function apiOfflineMerchants(){
        
        $merchants = Merchant::where('offline', 1)->get();
        if($merchants){
            return response()->json($merchants, 200);
        }
        return response()->json(['error' => 'Error'], 400);
    }
    public function apiOfflineMerchant(){

        $merchants = Merchant::where('offline', 1)->get();
        if($merchants){
            return response()->json(['success' => 'success', 'merchants' => $merchants ], 200);
        }
        return response()->json(['error' => 'Error'], 400);
    }
    public function index(){
        $products = Product::where('merchant_id', Auth::user()->marchant->id)->orderby('id', 'desc')->paginate(8);
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        return view('merchant.productList', compact('products','messg'));
    }    
    public function apiALLProduct(){
        $d2 = \Request::ip();     
        $merchant = Storage::select('storage')->where('token', $d2)->first();
        if($merchant){
            $products = Product::where('adstatus', 1)->where('merchant_id', $merchant->storage)
            ->join('variations', function($join){ 
                $join->on('products.id', '=', 'variations.product_id')
                ->where('onload', 1);
            })
            ->select('products.id','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
            ->orderby('id', 'desc')->take(9)->get();
            return response()->json($products, 200);
        }
        else {
            $products = Product::where('adstatus', 1)->where('merchant_id',8)
            ->join('variations', function($join){ 
                $join->on('products.id', '=', 'variations.product_id')
                ->where('onload', 1);
            })
            ->select('products.id','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
            ->orderby('id', 'desc')->take(9)->get();
           return response()->json($products, 200);
        }
           
        
    }
    public function apiSearchProduct($query){
        $d2 = \Request::ip();     
        $merchant = Storage::select('storage')->where('token', $d2)->first();
        if($merchant){
        $products = Product::where('adstatus', 1)->where('merchant_id',$merchant->storage)->where('name', 'like', '%'.$query.'%')
                    ->join('variations', function($join){ 
                        $join->on('products.id', '=', 'variations.product_id')
                        ->where('onload', 1);
                    })
                    ->select('products.id','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                    ->orderby('id', 'desc')->take(20)->get();
        return response()->json($products, 200);
        }
        else {
            $products = Product::where('adstatus', 1)->where('merchant_id',8)->where('name', 'like', '%'.$query.'%')
                    ->join('variations', function($join){ 
                        $join->on('products.id', '=', 'variations.product_id')
                        ->where('onload', 1);
                    })
                    ->select('products.id','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                    ->orderby('id', 'desc')->take(20)->get();
        return response()->json($products, 200);
        }
    }
    public function getProduct($slug,$id=null){
                $product = Product::select('id', 'name', 'merchant_id', 'slug', 'category_id', 'brand', 'images', 'thumbnail', 'views')
                    ->where('slug', 'like', '%'.$slug.'%')
                    ->with('properties:product_id,description,measurement', 'variations:id,product_id,color,size,unit,qty,price,v_price,discount,onload,image')
                    ->first();
        if($product){
            return response()->json($product, 200);
        }
        return response()->json(['error'=>'No Product Found'], 400);
    }
    public function api_Dis_Product(){
        $d2 = \Request::ip();     
		$merchant = Storage::select('storage')->where('token', $d2)->first();
	   if($merchant){           
        $products = \DB::table('products')->where('merchant_id', $merchant->storage)
				->join('variations', 'products.id', '=', 'variations.product_id')
				->select('products.id as id ','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id','variations.color','variations.size','variations.unit','variations.price','variations.v_price','variations.discount')
				->where('products.adstatus','=', 1)
				->where('variations.onload','=', 1)
				->where('variations.discount','!=', 0)
                ->where('variations.discount','!=', null)
                ->orderBy('products.id','DESC')
                ->take(9)
				->get();
                return response()->json($products, 200);
            }
            else {
                $products = \DB::table('products')->where('merchant_id', 8)
				->join('variations', 'products.id', '=', 'variations.product_id')
				->select('products.id as id ','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id','variations.color','variations.size','variations.unit','variations.price','variations.v_price','variations.discount')
				->where('products.adstatus','=', 1)
				->where('variations.onload','=', 1)
				->where('variations.discount','!=', 0)
                ->where('variations.discount','!=', null)
                ->orderBy('products.id','DESC')
                ->take(9)
				->get();
                return response()->json($products, 200);
            }     
    }
    public function api_cat_Product($slug){
        $d2 = \Request::ip();     
        $merchant = Storage::select('storage')->where('token', $d2)->first();
            if ($slug == 'flash-sale') {
            if($merchant){           
                $products = \DB::table('products')->where('merchant_id', $merchant->storage)
                        ->join('variations', 'products.id', '=', 'variations.product_id')
                        ->select('products.id as id ','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id','variations.color','variations.size','variations.unit','variations.price','variations.v_price','variations.discount')
                        ->where('products.adstatus','=', 1)
                        ->where('variations.onload','=', 1)
                        ->where('variations.discount','!=', 0)
                        ->where('variations.discount','!=', null)
                        ->orderBy('products.id','DESC')
                        ->get();
                        return response()->json($products, 200);
                    }
                    else {
                        $products = \DB::table('products')->where('merchant_id', 8)
                        ->join('variations', 'products.id', '=', 'variations.product_id')
                        ->select('products.id as id ','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id','variations.color','variations.size','variations.unit','variations.price','variations.v_price','variations.discount')
                        ->where('products.adstatus','=', 1)
                        ->where('variations.onload','=', 1)
                        ->where('variations.discount','!=', 0)
                        ->where('variations.discount','!=', null)
                        ->orderBy('products.id','DESC')
                        ->get();
                        return response()->json($products, 200);
                    }
            }
            elseif ($slug == 'latest-sale') {
                if($merchant){
                    $products = Product::where('adstatus', 1)->where('merchant_id', $merchant->storage)
                    ->join('variations', function($join){ 
                        $join->on('products.id', '=', 'variations.product_id')
                        ->where('onload', 1);
                    })
                    ->select('products.id','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                    ->orderby('id', 'desc')->get();
                    return response()->json($products, 200);
                }
                else {
                    $products = Product::where('adstatus', 1)->where('merchant_id',8)
                    ->join('variations', function($join){ 
                        $join->on('products.id', '=', 'variations.product_id')
                        ->where('onload', 1);
                    })
                    ->select('products.id','products.merchant_id','products.category_id','products.string','products.name','products.slug','products.images','products.thumbnail','variations.id as variation_id', 'variations.color', 'variations.size', 'variations.unit', 'variations.price', 'variations.v_price', 'variations.discount')
                    ->orderby('id', 'desc')->get();
                return response()->json($products, 200);
                }
            
            }         
    }
    public function create(){
        Session::forget('color');
        Session::forget('size');
        $categories  = Category::where('parent', 0)->get();
        $colorcode  = ColorCode::where('status', 1)->get();
        $weight  = Weight::get()->sortBy('name');
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        $brand=Brand::latest()->get();
    	return view('merchant.add-product', compact('categories','colorcode','weight','messg','brand'));
    }
    public function store(Request $r){
        // dd($r->images);
        $this->validate($r,[
			'category'       =>'required|integer',
			'name'           =>'required|string',
			'details'        =>'required|string',
			'brand'          =>'sometimes|nullable|string',
			'color'          =>'sometimes|nullable|string',
			'size'           =>'sometimes|nullable|integer',
			'qty'            =>'required|integer',
			'status'         =>'required|integer',
			'defVar'         =>'required|integer',
			'images.*'       =>'image|mimes:jpg,png,jpeg|max:5000',
       	]);
       	$imageNames = [];
       	$thumbnail = [];

      	$category = Category::find($r->category);
      	$p = Product::create([
      		'merchant_id'=> Auth::user()->marchant->id
      		,'category_id'=>$category->id
      		,'string'=>$category->string
      		,'name'=>$r->name
      		,'slug'=> str_slug($r->name).'-'.Auth::user()->id.time()
      		,'brand'=>$r->brand
      		,'images'=>'Null'
      		,'thumbnail'=>'Null'
      		,'status'=>$r->status
      		,'adstatus'=>0
      		,'storage'=> Auth::user()->marchant->id
      		,'offline'=>Auth::user()->marchant->offline
          ]);
        $prop = new Property;
        $prop->product_id = $p->id;
        $prop->description = $r->details;
        $prop->save();
        if(Session::has('color')){
        foreach(Session::get('color') as $color){
            if($color['color']){                        
                $tmpCol = [];               
                if(!in_array($color['color'], $tmpCol)){
                    $col = new Color;
                    $col->product_id= $p->id;
                    $col->name= $color['color'];
                    $col->image= $color['image'];
                    $col->save();
                    $old_path =  public_path().'/uploads/'. $color['image'];
                    if(file_exists($old_path)){
                        $images = Image::canvas(600, 600, '#fff');
                        $image  = Image::make($old_path)->resize(600, 600, function($constraint){
                            $constraint->aspectRatio();
                        });
                        $images->insert($image, 'center');
                        $pathImage = 'product_variation/' . date("Y") . '/' . date("m") . '/';                            
                        $Image =  date("Y") . '/' . date("m") . '/'.$p->id.'-';                         
                        if (!file_exists($pathImage)){
                            mkdir($pathImage, 0777, true);
                            $name =$Image.$col->image;                    
                            $images->save('product_variation/'.$name);
                            $col->image =  $name;
                        }else{
                            $name =$Image.$col->image;                    
                            $images->save('product_variation/'.$name);
                            $col->image =  $name;
                        } 
                        File::delete('uploads/'.$col->image);
                        unlink($old_path);
                        $col->save();
                    }/* else{
                        return redirect()->back()->with('danger', 'Error Occured');
                    } */
                    array_push($tmpCol, $color['color']);
                }
                
            }
         }
       }
        
        foreach(Session::get('size') as $key => $size){
            if(Session::has('color')){
                foreach(Session::get('color') as $color){
                    if($color['color'] == $size['color']){ 
                        $var = new Variation;
                        $var->product_id = $p->id;
                        $var->color = $size['color'];
                        $var->size = $size['size'];
                        $var->unit = $size['unit'];
                        $var->qty = $size['qty'];
                        $var->price = $size['price'];
                        $var->v_price = $size['v_price'];
                        $var->discount = $size['discount'];
                        $Image =  date("Y") . '/' . date("m") . '/'.$p->id.'-';
                        $var->image = $Image.$color['image'];
                        if($key == $r->defVar){
                            $var->onload = 1;
                        }
                        $var->save();
                    }
                }
            }else{
                    $var = new Variation;
                    $var->product_id = $p->id;
                    $var->color = $size['color'];
                    $var->size = $size['size'];
                    $var->unit = $size['unit'];
                    $var->qty = $size['qty'];
                    $var->price = $size['price'];
                    $var->v_price = $size['v_price'];
                    $var->discount = $size['discount'];
                    $var->discount = 0;
                    if($key == $r->defVar){
                        $var->onload = 1;
                    }
                    $var->save();
            }
        }
        
		if(count($r->file('images')) <= 3){
		    $files = $r->file('images');
			foreach ($files as $file) {
				/* $name =  $file->getClientOriginalName(); */
                $images = Image::canvas(600, 600, '#fff');
                $image  = Image::make($file->getRealPath())->resize(600, 600, function($constraint){
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $pathImage = date("Y") . '/' . date("m") . '/'.'images/';
                $pathImg = 'product_images/'.date("Y") . '/' . date("m") . '/'.'images/';
                $nameReplacer = time().'-'.uniqid().'-'.$p->id. '.' . $file->getClientOriginalExtension();
                if (!file_exists($pathImg)){
                    mkdir($pathImg, 0777, true);
                    $imageNames[]  = $pathImage.$nameReplacer;
                    $images->save('product_images/'.$pathImage.$nameReplacer);
                }else{
                    $imageNames[]  = $pathImage.$nameReplacer;
                    $images->save('product_images/'.$pathImage.$nameReplacer);
                }
                $thumbs = Image::canvas(300, 300, '#fff');
                $thumb  = Image::make($file->getRealPath())->resize(300, 300, function($constraint){
                    $constraint->aspectRatio();
                });
                $thumbs->insert($thumb, 'center');
                $paththumbnail = date("Y") . '/' . date("m") . '/'.'thumbnail/';
                $paththumb = 'product_images/'.date("Y") . '/' . date("m") . '/'.'thumbnail/';
                $nameReplacer =time() .'-'.uniqid(). '-'.$p->id. '.' . $file->getClientOriginalExtension();
                if (!file_exists($paththumb)){
                    mkdir($paththumb, 0777, true);
                    $thumbnail[] = $paththumbnail.$nameReplacer;
                    $thumbs->save('product_images/'.$paththumbnail.$nameReplacer);
                }else{
                    $thumbnail[] = $paththumbnail.$nameReplacer;
                    $thumbs->save('product_images/'.$paththumbnail.$nameReplacer);
                }
			}
		}
		$p->images = implode('|', $imageNames);
		$p->thumbnail = implode('|', $thumbnail);
        $p->save();
        
        Session::forget('color');
        Session::forget('size');
      return redirect()->back()->with('success', "Product \"<strong>$p->name</strong>\" Added Successfully");
}
    public function Pcolor(Request $request){
        $this->validate($request,[
			'Pcolor'               =>'required|string|',
			'Pimage'            =>'image|mimes:jpg,png,jpeg|max:5000',
           ]);
              $name;
                if($request->hasFile('Pimage')) {
                    $file = $request->file('Pimage');
                    $name = time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $image['filePath'] = $name;
                    $file->move(public_path().'/uploads/', $name);

                }
                $colors = array();
                if(Session::has('color')){
                    $colors = Session::get('color');
                }
                if(!in_array($request->Pcolor, array_column($colors, 'color'))) {
                    $color['color'] = $request->Pcolor; 
                    $color['image'] = $name;
                    array_push($colors, $color);
                    \Session::put('color', $colors);
                    return response()->json(['colors' => json_encode($colors)], 200);
                }
                return response()->json('Color Already Exists', 400);
           
    }
    public function Color(Request $request,$id){ 
        try{      
        $option=$request->tab;
        $this->validate($request,[
			'name'               =>'required|string',
			'image'            =>'required|image|mimes:jpg,png,jpeg|max:5000',
           ]);
           $d=Product::find($id)->colors;
           if(count($d)>0){

           dd($d);
           }
           foreach ($d as $key => $value) {
            if($value->name==$request->name){                
                return  redirect()->route('merchant.productEdit',[$id,$option])->withErrors(['You can not create same color']);
               }
            } 
           if(count($d)>=1){
                if($request->hasFile('image')){
                    $col=new Color;
                    $col->product_id= $id;
                    $col->name= $request->name;
                    $file = $request->file('image');
                    $images = Image::canvas(600, 600, '#fff');
                    $image  = Image::make($file)->resize(600, 600, function($constraint){
                        $constraint->aspectRatio();
                    });
                    $images->insert($image, 'center');
                    $pathImage = 'product_variation/' . date("Y") . '/' . date("m") . '/';                            
                    $Image =  date("Y") . '/' . date("m") . '/'.$id.'-'.time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();                       
                    if (!file_exists($pathImage)){
                        mkdir($pathImage, 0777, true);
                        $name =$Image;                    
                        $images->save('product_variation/'.$name);
                        $col->image =  $name;
                    }else{
                        $name =$Image;                    
                        $images->save('product_variation/'.$name);
                        $col->image =  $name;
                    } 
                    $col->save();
                }                   
        }else{
            return  redirect()->route('merchant.productEdit',[$id,$option])->withErrors(['You can not create color']);
        } 
        
        return  redirect()->route('merchant.productEdit',[$id,$option]);
        }catch (Exception $e) {
            report($e);
            return false;
        }
    }
    public function variation(Request $request,$id){  
        $option='nav-variation';
        $this->validate($request,[
			'price'               =>'required|integer',
			'v_price'               =>'required|integer',
			'qty'               =>'required|integer',
			'color'               =>'sometimes|nullable|string',
            'size'               =>'sometimes|nullable|integer',
            'unit'               =>'sometimes|nullable|string',
            'discount'           =>'sometimes|nullable|integer',
           ]);
            if ($request->price > $request->v_price) {    
                $var=new Variation();
                $var->color=$request->color;
                $var->size=$request->Psize;
                $var->unit=$request->unit;
                $var->price=$request->price;
                $var->qty=$request->qty;        
                $var->v_price = $request->v_price;
                $var->discount = $request->discount;
                $var->product_id=$id;
                $var->save();       
                $d=Product::find($id)->colors->where('name',$request->color);        
                foreach ($d as $key => $value) {          
                    $old_path =  public_path().'/color/'. $value->image;                                   
                    $file=$value->image;
                    if(file_exists($old_path)){                            
                        $images = Image::canvas(600, 600, '#fff');
                        $image  = Image::make($old_path)->resize(600, 600, function($constraint){
                            $constraint->aspectRatio();
                        });
                        $images->insert($image, 'center');                                   
                        $Image =  date("Y") . '/' . date("m") . '/'.uniqid(); 
                        $pathImage = 'product_variation/' . date("Y") . '/' . date("m") . '/';                        
                        if (!file_exists($pathImage)){
                            mkdir($pathImage, 0777, true);                  
                            $name =$Image.$value->image;                    
                            $images->save('product_variation/'.$name);
                            $var->image =  $name;
                        }else{                  
                            $name =$Image.$value->image;                    
                            $images->save('product_variation/'.$name);
                            $var->image =  $name;
                            }                   
                        $var->save();  
                    }
                
                }
            
                return  redirect()->route('merchant.productEdit',[$id,$option]);
            }else{
                return  redirect()->route('merchant.productEdit',[$id,$option])->withErrors(['Price must be grater than v_price']);
            }
    }
    public function variation_update(Request $request,$id){
        
        $this->validate($request,[
			'price'               =>'required|integer|',
            'qty'               =>'required|integer|',
            'v_price'               =>'required|integer',
            'discount'           =>'sometimes|nullable|integer',
           ]);
        $variation=Variation::findOrFail($id);
       
        if ($request->default) { 
            foreach ($variation->product->variations as  $var) {                               
                $var->onload=0; 
                $var->save();  
            }
        }
        $varUpdate = Variation::findOrFail($id);
        $varUpdate->qty=$request->qty;
        $varUpdate->price=$request->price;
        $varUpdate->v_price = $request->v_price;
        $varUpdate->discount = $request->discount;
        if($request->default){
            // dd($request->default);
            $varUpdate->onload = $request->default;
        }
        $varUpdate->status=($request->status == 1 ?$request->status:0);
        $varUpdate->save();
        $option='nav-variation';
        return  redirect()->route('merchant.productEdit',[$variation->product_id,$option]);
    }
    public function delete_variation(Request $request,$id)
        {
        $option='nav-variation';
        $var=Variation::findOrFail($id);
        $d=Product::find($var->product_id)->variations->count();
        if ($d>1) {
            $var->delete();        
        }
        $d=Product::find($var->product_id)->variations;
        if(count($d)>=1){
           foreach ($d as $key => $value) {
            $value->onload=1;
            $value->save();
           }  
        }
        return  redirect()->route('merchant.productEdit',[$request->p_id,$option]);
    }
    public function psize(Request $request){
        $this->validate($request,[
			'price'               =>'required|integer|',
			'v_price'               =>'required|integer|',
			'qty'               =>'required|integer|',
			'size'           =>'sometimes|nullable|integer',
			'unit'           =>'sometimes|nullable|string',
			'discount'           =>'sometimes|nullable|integer',
			'qty'            =>'required|integer',
           ]);
        $sizes = array();
        if(Session::has('size')){
            $sizes = Session::get('size');
        }
        if(in_array($request->color, array_column($sizes, 'color')) ) {
            foreach($sizes as $size){
                if($size['color'] == $request->color && $size['size'] == $request->size && $size['unit'] == $request->unit){
                    return response()->json('Size Already Exists', 400);
                }
                if(!$request->price > $request->v_price ){
                    return response()->json('Price must be grater than v_price', 400);
                }
            }
        }
        $size['color'] = $request->color;
        $size['size'] = $request->size;
        $size['unit'] = $request->unit;
        $size['qty'] = $request->qty;
        $size['price'] = $request->price;
        $size['v_price'] = $request->v_price;
        $size['discount'] = $request->discount;
        array_push($sizes, $size);
        \Session::put('size', $sizes);

        return response()->json(['sizes' => json_encode($sizes)], 200);
    }
    public function psizeDelet($index){
        if(Session::has('size')){
            $sizes = Session::get('size');
            unset($sizes[$index]);
            $newArray = array_values($sizes);
            \Session::put('size', $newArray);
            return response()->json(['sizes' => json_encode($newArray)], 200);
        }
        return response()->json('No Size Added', 400);
    }
    public function productEdit($id,$option=null)
        {      
            if (!$option) {
                $option='nav-home';
            }         
        /*  Session::forget('color');
            Session::forget('size'); */
            $product=Product::findOrFail($id);
            $colorcode  = ColorCode::where('status', 1)->get();
            $weight  = Weight::get()->sortBy('name');
            $categories  = Category::where('parent', 0)->get();
            $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
            $brand=Brand::latest()->get();
            return view('merchant.updateProduct', compact('product','categories','option','colorcode','weight','messg','brand'));
        }
    public function productimage_update(Request $r,$id){
        $this->validate($r,[
			'images.*'            =>'image|mimes:jpg,png,jpeg|max:5000',
           ]);
         $product=Product::findOrFail($id); 
         $imageNames = explode('|', $product->images); 
         $thumbnails = explode('|', $product->thumbnail); 
         if($r->hasFile('images')){
         $file = $r->file('images');
         $images = Image::canvas(600, 600, '#fff');
         $image  = Image::make($file->getRealPath())->resize(600, 600, function($constraint){
             $constraint->aspectRatio();
         });
         $images->insert($image, 'center');
         $path = 'product_images/'.date("Y") . '/' . date("m") . '/'.'images/';
         $pathImage = date("Y") . '/' . date("m") . '/'.'images/';
         $nameReplacer = time().'-'.uniqid().'-'.$product->id. '.' . $file->getClientOriginalExtension();
         if (!file_exists($path)){
             mkdir($path, 0777, true);
             $newName  = $names = $pathImage.$nameReplacer;
         }else{
             $newName  = $names = $pathImage.$nameReplacer;
         }
            $oldImg = $imageNames[$r->key];   
            File::delete('product_images/'.$oldImg);
            $images->save('product_images/'.$names);
            $imageNames[$r->key] = $newName;
            $product->images=implode('|',$imageNames);
            /* $product->save(); */
            //thumbnail
            $thumbs = Image::canvas(300, 300, '#fff');
            $thumb  = Image::make($file->getRealPath())->resize(300, 300, function($constraint){
                $constraint->aspectRatio();
            });
            $thumbs->insert($thumb, 'center');
            $paththumb = 'product_images/'.date("Y") . '/' . date("m") . '/'.'thumbnail/';
            $paththumbnail = date("Y") . '/' . date("m") . '/'.'thumbnail/';
            $nameReplacer =time() .'-'.uniqid(). '-'.$product->id. '.' . $file->getClientOriginalExtension();
            if (!file_exists($paththumb)){
                mkdir($paththumb, 0777, true);
                $thumbimg = $thumbName= $paththumbnail.$nameReplacer;                
            }else{
                $thumbimg = $thumbName = $paththumbnail.$nameReplacer;
            }
             
            $oldImgs = $thumbnails[$r->key]; 
            File::delete('product_images/'.$oldImgs);
            $thumbs->save('product_images/'.$thumbName);
            $thumbnails[$r->key] = $thumbimg;
            $product->thumbnail=implode('|',$thumbnails);
            $product->save();

        }
        $option='nav-home';
        return  redirect()->route('merchant.productEdit',[$id,$option]);
      }
    public function productimage_add(Request $r,$id){
        $this->validate($r,[
			'images.*'            =>'image|mimes:jpg,png,jpeg|max:5000',
           ]);
         $p=Product::findOrFail($id);         
         $imageNames = explode('|', $p->images); 
         $thumbnail = explode('|', $p->thumbnail); 
         
         if($r->file('images')){
             $files = $r->file('images');
             foreach ($files as $key => $file) {                 
                $images = Image::canvas(600, 600, '#fff');
                $image  = Image::make($file->getRealPath())->resize(600, 600, function($constraint){
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $path = 'product_images/'.date("Y") . '/' . date("m") . '/'.'images/';
                $pathImage = date("Y") . '/' . date("m") . '/'.'images/';
                $nameReplacer = time().'-'.uniqid().'-'.$p->id. '.' . $file->getClientOriginalExtension();
                if (!file_exists($path)){
                    mkdir($path, 0777, true);
                    $imageNames[]  = $pathImage.$nameReplacer;
                    $images->save('product_images/'.$pathImage.$nameReplacer);
                }else{
                    $imageNames[]  = $pathImage.$nameReplacer;
                    $images->save('product_images/'.$pathImage.$nameReplacer);
                }
                $thumbs = Image::canvas(300, 300, '#fff');
                $thumb  = Image::make($file->getRealPath())->resize(300, 300, function($constraint){
                    $constraint->aspectRatio();
                });
                $thumbs->insert($thumb, 'center');
                $paththumb = 'product_images/'.date("Y") . '/' . date("m") . '/'.'thumbnail/';
                $paththumbnail = date("Y") . '/' . date("m") . '/'.'thumbnail/';
                $nameReplacer =time() .'-'.uniqid(). '-'.$p->id. '.' . $file->getClientOriginalExtension();
                if (!file_exists($paththumb)){
                    mkdir($paththumb, 0777, true);
                    $thumbnail[] = $paththumbnail.$nameReplacer;
                    $thumbs->save('product_images/'.$paththumbnail.$nameReplacer);
                }else{
                    $thumbnail[] = $paththumbnail.$nameReplacer;
                    $thumbs->save('product_images/'.$paththumbnail.$nameReplacer);
                }                 
                 $p->images = implode('|', $imageNames);
                 $p->thumbnail = implode('|', $thumbnail);
                 $p->save();
             }
         }
         $option='nav-home';
         return  redirect()->route('merchant.productEdit',[$id,$option]);
      }

    public function delete_defaultimg(Request $r,$id){
        $p=Product::findOrFail($id);              
        $delimg = explode('|', $p->images);
        $delthumimg = explode('|', $p->thumbnail);
        $del=$delimg[$r->key];        
        $delthum=$delthumimg[$r->key];        
        File::delete('product_images/'.$del);  
        File::delete('product_images/'.$delthum);  
        unset($delimg[$r->key]); 
        unset($delthumimg[$r->key]); 
        $p->images=implode('|',$delimg);
        $p->thumbnail=implode('|',$delthumimg);
        $p->save();        
        $option='nav-home';
        return  redirect()->route('merchant.productEdit',[$id,$option]);
     }
    
    public function delete_Color_img(Request $r,$id){
        $colr=Color::findOrFail($id);
        $d=Product::find($colr->product_id)->colors->count();        
        if ($d>1) {
            File::delete('product_variation/'.$colr->image);
            $colr->delete();
            $var=Variation::where('product_id',$colr->product_id)->where('color',$colr->name)->get();
            if($var){
                foreach ($var as $key => $value) {
                   $value->delete();
                }
            }
        }       
        $option='nav-variation';
        $id=$colr->product_id;      
        return  redirect()->route('merchant.productEdit',[$id,$option]);
     }
    
    
    public function productUpdate(Request $r, $id){
        $this->validate($r,[
			'category'        =>'required|integer',
			'name'            =>'required|string|',
			'brand'           => 'sometimes|nullable|string',
       	]);

          $category = Category::find($r->category);        
          $p =Product::findOrFail($id);
          $p->merchant_id = Auth::user()->marchant->id;
          $p->category_id = $category->id;
          $p->string = $category->string;
          $p->name = $r->name;
          $p->slug = str_slug($r->name);
          $p->brand = $r->brand;
          $p->save(); 
          $option='nav-home';
        return redirect()->route('merchant.productEdit',[$id,$option])->with('success', "Product \"<strong>$p->name</strong>\" update Successfully");

    }
    public function propertyupdate(Request $r,$id){
        $this->validate($r,[
            'details'            =>'required|string',
            'status'               =>'required',
        ]);
        $pro=Product::findOrFail($id);
        $pro->status=$r->status;
        $pro->save();
        $property=Property::findOrFail( $pro->properties->id);
        $property->description=$r->details;
        $property->save();
        $option='nav-info';
        return  redirect()->route('merchant.productEdit',[$id,$option]);
    }
    public function deletMarProd($id){
        $product   = Product::find($id);
        $color     = $product->colors;
        $variation = $product->variations;
        $pro       = $product->properties;
        if($color){
        foreach ($color as $key => $value) {
          $value->delete();
          if ($value->image) {
            File::delete('product_variation/'.$value->image);
          }
        }
        }
        if($variation){
          foreach ($variation as $key => $value) {
            $value->delete();
          }
        }
        if ($pro) {
          $pro->delete();
        }
        if($product){
          $delimg = explode('|', $product->images);
          $delthumimg = explode('|', $product->thumbnail);
          foreach ($delimg as $key => $value) {
            File::delete('product_images/'.$value);
          }
          foreach ($delthumimg as $key => $value) {
            File::delete('product_images/'.$value);
          } 
          $product->delete();
      }
        return redirect()->back()->with('success', "Product $product->product_name deleted Successfully");
      }
}
