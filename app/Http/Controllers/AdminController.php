<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Message;
use App\Order;
use App\Brand;
use App\ColorCode;
use App\Weight;
use App\Slide;
use Image;
use Auth;
use File;

class AdminController extends Controller
{
    public function dashboard(){
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    	return view('admin.home',compact('messg'));
    }
    public function adminAllProduct(){
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        $products = Product::orderby('id', 'desc')->paginate(6);      
        return view('admin.productList', compact('products','messg'));
    }
      
    public function adminSingleProduct($id){
        $product = Product::find($id); 
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();      
        return view('admin.productSingle', compact('product','messg'));
      }
    public function adminApproveProd($id){
        $product = Product::find($id);    
        if($product->adstatus){
            $product->adstatus = 0;
            $msg = 'Product disable Successfully !';
        }else{
            $product->adstatus = 1;
            $msg = 'Product approved Successfully !';
        }
        $product->save();
        return redirect()->back()->with('success', $msg);
    }
    public function message(Request $r,$id){
         $d=Product::findOrFail($id);
         $msg=new Message;
         $msg->product_id=$id;         
         $msg->sender=Auth::user()->id;
         $msg->receiver=$d->merchant_id;
         $msg->message=$r->message;
         $msg->status = 1;
         $msg->save();
         return redirect()->back()->with('success', "Message sent Successfully !");
    }
    public function message_see($id){
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        $message=Message::where('product_id',$id)->get();
        return view('admin.message',compact('id','messg','message'));
     }
     public function message_send(Request $r){ 
        $msg=new Message;
        $msg->product_id=$r->pro;
        $msg->receiver=$r->rcv;
        $msg->sender=Auth::user()->id;
        $msg->message=$r->message;
        $msg->status = 1;
        $msg->save();
        return response()->json($msg);
   }
   public function message_change(Request $request,$id){

    $data=Product::findOrFail($id)->messages->where('receiver',Auth::user()->id);
    foreach ($data as $key => $value) {                 
        $value->s_status=1;
        $value->save();        
    }
    return response()->json($data);
}
public function adminAllOrders(){
    $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    $orders = Order::orderby('id', 'desc')->get();
    // dd(Auth::user()->marchent->id);
    return view('admin.order', compact('orders','messg'));
  }
  public function adminOrderEdit($id){
    $order = Order::find($id);
    $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    return view('admin.orderEdit', compact('order','messg'));
  }
  public function addcolor(){
      $colors=ColorCode::orderby('orders', 'desc')->paginate(8);
      $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
      return view('admin.add-color',compact('colors','messg'));
  }
  public function storecolor(Request $r){
      
      $this->validate($r,[
        'color'   =>'required|unique:color_codes,color',
        'code' =>'required|string',
    ]);
        $data=new ColorCode;
        $data->color=$r->color;         
        $data->slug=str_slug($r->color);
        $data->code=$r->code;
        $data->save();
        return redirect()->back()->with('success', "Color <strong>$data->name</strong> add successfully!!");
  }
  public function editcolor($id){
      $data=ColorCode::findOrFail($id);
      $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
      return view('admin.edit-color',compact('data','messg'));
  }
  public function updatecolor(Request $r,$id){
      
      $this->validate($r,[
        'color'   =>'required|unique:color_codes,color,'.$id,
        'orders'   =>'sometimes|nullable|unique:color_codes,orders,'.$id,
        'code' =>'required|string',
    ]);
        $data=ColorCode::findOrFAil($id);
        $data->color=$r->color;         
        $data->orders=$r->orders;         
        $data->slug=str_slug($r->color);
        $data->code=$r->code;
        $data->save();
        return redirect()->back()->with('success', "Color <strong>$data->name</strong> add successfully!!");
  }
    public function deleteColor($id){
        $data=ColorCode::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', "Color <strong>$data->name</strong> delete successfully!!");
            
    }
    public function weight(){
        $weight=Weight::get()->sortBy('name');
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        return view('admin.weight',compact('weight','messg'));
    }
    public function addWeight(Request $r){
      
        $this->validate($r,[
          'name'   =>'required|unique:weights,name',
      ]);
          $data=new Weight;
          $data->name=$r->name;
          $data->save();
          return redirect()->back()->with('success', "Weight <strong>$data->name</strong> add successfully!!");
    }
    public function deleteWeight($id){
        $data=Weight::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', "Weight <strong>$data->name</strong> delete successfully!!");
            
    }
    public function profile(){
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        return view('admin.profile',compact('messg'));
    }
    public function prductDelete($id){
        $product   = Product::find($id);
        $color     = $product->colors;
        $variation = $product->variations;
        $pro       = $product->properties;
        $mesg       = $product->messages;
        if(count($color)>0){
        foreach ($color as $key => $value) {
          $value->delete();
          if ($value->image) {
            File::delete('product_variation/'.$value->image);
          }
        }
        }
        if(count($variation)>0){
          foreach ($variation as $key => $value) {                      
            $value->delete();
          }
        }
        if(count($mesg)>0){
          foreach ($mesg as $key => $value) {                      
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
        return redirect()->back()->with('danger', "Product $product->product_name deleted Successfully");
      }
 public function orders(Request $r){
            $this->validate($r,[
              'orders'   =>'sometimes|nullable|unique:color_codes,orders,'.$r->id,
          ]);
        $data=ColorCode::findOrFail($r->id);
        $data->orders=$r->orders;
        $data->save();
        return response()->json($data);
      }
 public function brand_orders(Request $r){
            $this->validate($r,[
              'orders'   =>'sometimes|nullable|unique:brands,orders,'.$r->id,
          ]);
        $data=Brand::findOrFail($r->id);
        $data->orders=$r->orders;
        $data->save();
        return response()->json($data);
      }
 public function user_id(Request $r){
            $this->validate($r,[
              'user_id'   =>'sometimes|nullable|unique:brands,user_id,'.$r->id,
          ]);
        $data=Brand::findOrFail($r->id);
        $data->user_id=$r->user_id;
        $data->save();
        return response()->json($data);
      }
      public function brand_list(){
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
        $brand=Brand::get()->sortBy('orders');
        return view('admin.brand',compact('brand','messg'));
      }
      public function adminApproveBrand($id){
        $data = Brand::find($id);  
        if($data->verified){
           $data->verified = 0;
            $msg = 'Brand disable Successfully !';
        }else{
          $data->verified = 1;
            $msg = 'Brand approved Successfully !';
            
        }
        $data->save();
        return redirect()->back()->with('success', $msg);
    }
    public function brand_delete($id){
      $data=Brand::findOrFail($id);
      $data->delete();
      return redirect()->back()->with('success', "Brand delete successfully!!");
    }
    public function edit_brand($id){
      $brand=Brand::findOrFail($id);
      $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
       return view('admin.edit-brand',compact('brand','messg'));
    }
    public function update_brand(Request $r,$id){
      $this->validate($r,[
        'name'   =>'sometimes|nullable|unique:brands,name,'.$r->id,
    ]);
      $brand=Brand::findOrFail($id);
      $brand->name=$r->name;
      $brand->user_id=$r->user_id;
      $brand->orders=$r->orders;
      $brand->save();
      return redirect()->back()->with('success', "Brand <strong> $brand->name </strong> update successfully!!");
    }
  public function add_brand(Request $r){
    $this->validate($r,[
      'brand'   =>'sometimes|nullable|unique:brands,name',
  ]);
  $brand=new Brand;
  $brand->name=$r->brand;
  $brand->user_id=$r->user_id;
  $brand->orders=$r->orders;
  $brand->verified=1;
  $brand->save();
  return redirect()->back()->with('success', "Brand <strong> $brand->name </strong> added successfully!!");
  }
  public function slides(){
    $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    $slides=Slide::latest()->get();
    return view('admin.slide',compact('slides','messg'));
  }
  public function add_slide(){
    $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    return view('admin.add_slide',compact('messg'));
  }
  public function store_slide(Request $r){
    
        $this->validate($r,[
          'title'   =>'sometimes|nullable|unique:slides,title',
      ]);
      $slide=new Slide;
      $slide->title=$r->title;
      $slide->description=$r->description;
      if($r->hasFile('image')){
        $file = $r->file('image');
        $images = Image::canvas(1000, 400, '#fff');
        $image  = Image::make($file)->resize(1000, 400, function($constraint){
            $constraint->aspectRatio();
        });
        $images->insert($image, 'center');
        $pathImage = 'slide/';
        if (!file_exists($pathImage)){
            mkdir($pathImage, 0777, true);
            $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();                    
            $images->save('slide/'.$name);
            $slide->image =  $name;
        }else{
            $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();   
            /* File::delete('slide/profile/'.$profile->image); */
            $images->save('slide/'.$name);
            $slide->image =  $name;
         } 
        }
        $slide->save();
      return redirect()->back()->with('success', "Slide added successfully!!");
      }
    public function adminApproveSlide($id){
    $data = Slide::find($id); 
    if($data->status){
      $data->status = 0;
      $msg = 'Slide disable Successfully !';
    }
    else{
      $data->status = 1;
      $msg = 'Slide approved Successfully !';

    }
    $data->save();
    return redirect()->back()->with('success', $msg);
    }
  public function edit_slide($id){
    $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    $data=Slide::findOrFail($id);
    return view('admin.edit_slide',compact('data','messg'));
  }
  public function update_slide(Request $r,$id){
       
        $this->validate($r,[
          'title'   =>'sometimes|nullable|unique:slides,title,'.$id,
      ]);
      $slide=Slide::findOrFail($id);
      $slide->title=$r->title;
      $slide->description=$r->description;
      if($r->hasFile('image')){
        $file = $r->file('image');
        $images = Image::canvas(1000, 400, '#fff');
        $image  = Image::make($file)->resize(1000, 400, function($constraint){
            $constraint->aspectRatio();
        });
        $images->insert($image, 'center');
        $pathImage = 'slide/';                                                   
        if (!file_exists($pathImage)){
            mkdir($pathImage, 0777, true);
            $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();                    
            $images->save('slide/'.$name);
            $slide->image =  $name;
        }else{
            $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();   
            File::delete('slide/'.$slide->image);
            $images->save('slide/'.$name);
            $slide->image =  $name;
         } 
        }
        $slide->save();
      return redirect()->back()->with('success', "Slide update successfully!!");
      }
      public function delete_slide($id){
        $data=Slide::findOrFail($id);
        File::delete('slide/'.$data->image);
        $data->delete();
        return redirect()->back()->with('success', "Slide delete successfully!!");
      }
      public function sliderImages(){
        $sliders = Slide::all();
        return response()->json($sliders,200);
      }
}

