<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Message;
use App\Product;
use App\Brand;
use Auth;
use Image;
use File;
class MerchantController extends Controller
{
    function __construct(){
        $this->middleware('merchant');
      }
    public function dashboard(){
    	// dd('Merchant');
    	// $totOrdr = Order::where('merchant_id', Auth::id())->Where('status', 'Delivered')->count();
     //  	$totPend = Order::where('merchant_id', Auth::id())->Where('status', 'processing')->count();
     //  	$orders = Order::where('merchant_id', Auth::id())->Where('status', 'Delivered')->get();
     //  	$qty = 0;
     //  	$incm = 0;
     //  	foreach($orders as $o){
     //    	foreach($o->products as $p){
     //      		$qty += $p->qty;
     //      		$incm += $p->qty + $p->product->price;
     //    	}
     //  	}
     //  	$stoct = Product::where('merchant_id', Auth::id())->sum('stock_available');
    	// compact('totOrdr', 'totPend', 'qty', 'incm', 'stoct')
      $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
      	return view('merchant.home',compact('messg'));
    }
    public function apiOfflineMerchants(){
        $merchants = Merchant::where('offline', 1)->get();
        return response()->json(['success' => 'success', 'merchants' => $merchants ], 200);
    }
    public function productList(){
        $products = Product::where('merchant_id', Auth::user()->marchant->id)->paginate(2);  
       
        return view('merchant.productList', compact('products'));
      }
    public function message(Request $request,$id){
        $data=Product::findOrFail($id)->messages->where('receiver',Auth::user()->id);
        foreach ($data as $key => $value) {                 
            $value->s_status=1;
            $value->save();        
        }
        return response()->json($id);
    }
    public function message_see($id){
       $message=Message::where('product_id',$id)->get();
       $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
       return view('merchant.message',compact('message','id','messg'));
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
   function vendorProfile(){
    $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
    $brand=Brand::latest()->get();
    return view('merchant.profile',compact('messg','brand'));
 }
     
 function postVendorProfile(Request $r){
      $this->validate($r,[
        'vendor'=>'required|string',
        'address'=>'sometimes|nullable||string',
        'area'=>'sometimes|nullable||string',
        'phone'=>'sometimes|nullable|string',
        'email'=>'sometimes|nullable|string',
        'web'=>'sometimes|nullable|string',
        'account'=>'sometimes|nullable|string',
        'bankname'=>'sometimes|nullable|string',
        'accountname'=>'sometimes|nullable|string',
        'brand'=>'sometimes|nullable|string',
        'images'   =>'image|mimes:jpg,png,jpeg|max:5000',
      ]);
      $profile = Auth::user()->marchant;
      $profile->name = $r->vendor;
      $profile->address = $r->address;
      $profile->area = $r->area;
      $profile->email = $r->email;
      $profile->phone = $r->phone;
      $profile->web = $r->web;
      $profile->account = $r->account;
      $profile->bankname = $r->bankname;
      $profile->accountname = $r->accountname;
      $profile->save();

      return redirect()->back()->with('success', "profile  edit successfully!!");
    }
    public function brand(Request $r){
      $this->validate($r,[
        'brand'=>'sometimes|nullable|string',
      ]);
      $profile = Auth::user()->marchant;
      $profile->brand = $r->brand;
      $profile->save();
      $data=Brand::firstOrCreate(['name' => $r->brand]);
      $data->name=$r->brand;
      $data->save();
      return redirect()->back()->with('success', "Brand added successfully!!");
    }
public function profile_mage(Request $r){
 
  $profile = Auth::user()->marchant;  
  if($r->hasFile('image')){
    $file = $r->file('image');
    $images = Image::canvas(300, 300, '#fff');
    $image  = Image::make($file)->resize(300, 300, function($constraint){
        $constraint->aspectRatio();
    });
    $images->insert($image, 'center');
    $pathImage = 'merchant/profile/';                                                   
    if (!file_exists($pathImage)){
        mkdir($pathImage, 0777, true);
        $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();                    
        $images->save('merchant/profile/'.$name);
        $profile->image =  $name;
    }else{
        $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();   
        File::delete('merchant/profile/'.$profile->image);
        $images->save('merchant/profile/'.$name);
        $profile->image =  $name;
    } 
    $profile->save();
    return redirect()->back();
    }
  }
    
    public function vendorWithdraw(){
      $withdraws = Withdraw::where('user_id', Auth::id())->get();
      $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
      return view('merchant.withdraw', compact('withdraws','messg'));
    }
    public function postVendorWithdraw(Request $r){
      $this->validate($r,[
        'ammount'=>'required|string',
      ]);
      $withdraw = new Withdraw;
      $withdraw->user_id = Auth::id();
      $withdraw->ammount = $r->ammount;
      $withdraw->status = 0;
      $withdraw->save();
      return redirect()->back();
    }
}
