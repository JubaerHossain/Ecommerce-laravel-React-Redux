<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Child;
use App\Nephew;
use App\Product;
use App\Cart;
use App\Order;
use App\Morder;
use App\Cartproduct;
use Cookie;
use Session;

class HomeController extends Controller
{

    public function index(){
        $spacs = Product::where('status', 1)->where('adstatus', 1)->orderby('id', 'desc')->limit(40)->get();
        $cats = Category::where('parent', 0)->get();
        return view('main.home', compact('cats', 'spacs'));
    }
    public function poductDisplay($name){
        $nephew = Nephew::where('name', $name)->first();

        $cats = Category::where('parent', 0)->get();
        return view('main.listing', compact('cats','nephew'));
    }
    public function catView($id){
        $category = Category::find($id);

        $cats = Category::where('parent', 0)->get();
        return view('main.catView', compact('cats','category'));
    }
    public function subView($id){
        $child = Child::find($id);

        $cats = Category::where('parent', 0)->get();
        return view('main.childView', compact('cats','child'));
    }
    public function singleProduct($slug, $dpid = null){
        if(isset($dpid)){
            Cookie::queue(Cookie::make('drpidusrid', $dpid, 30*30*30*24));
        }
        $product = Product::where('slug', $slug)->first();
        $cats = Category::where('parent', 0)->get();
        return view('main.single', compact('cats','product'));
    }
    public function searchProd(Request $request){
        $this->validate($request, [
            'search_string' => 'required|string',
        ]);
        $products = Product::where('product_name', 'LIKE', "%$request->search_string%")->orWhere('details', 'LIKE', "%$request->search_string%")->where('dpstatus', 1)->where('status', 1)->limit('50')->get();
        $string = $request->search_string;

        $cats = Category::where('parent', 0)->get();
        return view('main.searchProd', compact('cats','products', 'string'));
    }
    public function shoppingCart(){
        // Session::forget('cart');
        if(!Session::has('cart')){
            return redirect()->route('home');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($cart);
        $cats = Category::where('parent', 0)->get();
        return view('main.cart', compact('cart','cats'));
    }
    public function postAddtoCart(Request $request, $id){
        $this->validate($request, [
            'pq' => 'required|integer',
            'size' => 'sometimes|nullable|string',
        ]);
        $products = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        if(Session::has('cart')){
            if($products->merchant_id != $cart->merchantId){
                return redirect()->back()->with('warning', "'Your Can't add Different Vendor Product in cart at a time!! Currently You are Purchasing Product From");
            }
        }
        $cart->add($products, $products->id, $request->pq, $request->size);
        $request->session()->put('cart', $cart);
        return redirect()->back()->with('carted', "Product \"$products->product_name\" Added to Cart");
    }
    public function deletFromCart($id){
        if(!Session::has('cart')){
            return redirect()->route('home');
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $msg = "Something went wront";
        if($cart->removeItem($id)){
            $msg = "Product removed from cart!";
        }
        Session::put('cart', $cart);

        return redirect()->back();
    }
    public function submitCheckout(){
        if(!Session::has('cart')){
            return redirect()->route('home');
        }
        if(!empty($request->did)){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->addDid($request->did);
            $request->session()->put('cart', $cart);
        }

        $cats = Category::where('parent', 0)->get();
        return redirect()->route('checkout');
    }
    public function checkout(){
        if(!Session::has('cart')){
            return redirect()->route('home');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $did = false;
        if(Cookie::get('drpidusrid') != null){ $did = Cookie::get('drpidusrid');}

        $cats = Category::where('parent', 0)->get();
        return view('main.buyNow', compact('cart','cats', 'did'));
    }
    public function checkoutOrder(Request $request){
        $this->validate($request, [
            'email' => 'required|string|email',
            'district' => 'required|string',
            'phone' => 'required|string',
            'shipping' => 'required|string',
            'address' => 'required|string',
            'pMethod' => 'required|string',
            'cashNumb' => 'required|string',
            'txnid' => 'required|string',
            'did' => 'sometimes|nullable|string'
        ]);
        // dd($request);
        if(!Session::has('cart')){
            return redirect()->route('home');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $did = null;
        if($request->did){$did = $request->did;}
        if(Cookie::get('drpidusrid') != null){ $did = Cookie::get('drpidusrid');}
        
        $order = new Order();
        $order->merchant_id = $cart->merchantId;
        $order->did = $did;
        $order->email = $request->email;
        $order->country = 'Bangladesh';
        $order->district = $request->district;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->shipping = $request->shipping;
        $order->status = 'processing';
        $order->subtotal = $cart->totalPrice;
        $order->discount = '0';
        $order->total = $cart->totalPrice;
        $order->pMethod = $request->pMethod;
        $order->cashNumb = $request->cashNumb;
        $order->txnid = $request->txnid;
        $order->save();

        $tot = 0;
        foreach ($cart->items as $item) {
            $products = new Cartproduct();
            $products->order_id = $order->id;
            $products->product_id = $item['item']['id'];
            $products->name = $item['item']['product_name'];
            $products->price = $item['item']['price'];
            $products->dp = $item['item']['dpp'];
            $products->size = $item['size'];
            $products->qty = $item['qty'];
            $products->save();
            $tot += $item['item']['price'] * $item['qty'];
        }

        $order->discount = $tot;
        $order->save();
        
         return redirect()->route('orderView', $order->id)->with('success', 'Your order placed successfully');
    }
    public function orderView($id){
        if(!Session::has('cart')){
            return redirect()->route('home');
        }
        $order = Order::find($id);

        $cats = Category::where('parent', 0)->get();
        Session::Forget('cart');
        return view('main.showOrder', compact('cats', 'order'));
    }
    public function productBuyNow(Request $request, $id){
        $this->validate($request, [
            'pq' => 'required|integer',
            'size' => 'sometimes|nullable|string',
        ]);
        $options = array();
        $options['pq'] = $request->pq;
        $options['size'] = $request->size;

        $product = Product::find($id);

        $cats = Category::where('parent', 0)->get();
        return view('main.buyNow', compact('cats', 'options', 'product'));
    }

    public function checkoutBuyNow(Request $request){

        $this->validate($request, [
            'email' => 'required|string|email',
            'district' => 'required|string',
            'phone' => 'required|string',
            'shipping' => 'required|string',
            'address' => 'required|string',
            'pq' => 'required|string',
            'size' => 'sometimes|nullable|string',
            'pMethod' => 'required|string',
            'cashNumb' => 'required|string',
            'txnid' => 'required|string',
            'id' => 'required|integer',
            'did' => 'sometimes|nullable|string'
        ]);
        $did = null;
        if(Cookie::get('drpidusrid') != null){
            $did = Cookie::get('drpidusrid');
        }
        if($request->did){
            $did = $request->did;
        }
        if($product = Product::find($request->id)){
            $order = new Morder();
            $order->product_id = $product->id;
            $order->merchant_id = $product->merchant->id;
            $order->did = $did;
            $order->email = $request->email;
            $order->country = 'Bangladesh';
            $order->district = $request->district;
            $order->size = $request->size;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->status = 'Processing';
            $order->name = $product->product_name;
            $order->price = $product->price;
            $order->qty = $request->pq;
            $order->dpp = $product->dpp;
            $order->discount = '0';
            $order->shipping = $request->shipping;
            $order->total = $product->price * $request->pq;
            $order->pMethod = $request->pMethod;
            $order->cashNumb = $request->cashNumb;
            $order->txnid = $request->txnid;
            $order->save();           
            
            return redirect()->back()->with('success', 'Your order placed successfully');
        }
        return redirect()->back()->with('message', 'Something Went Wrong');
    }
}
