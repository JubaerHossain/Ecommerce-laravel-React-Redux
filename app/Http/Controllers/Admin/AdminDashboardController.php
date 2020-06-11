<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Child;
use App\Nephew;
use App\Product;
use App\Order;
use Auth;
class AdminDashboardController extends Controller
{
	protected $pageTitle ;
    function __construct(){
    	$data = [];
    	$this->middleware('admin');
    	$this->pageTitle = "Admin || ";
    }
    function dashboard(){
    	$this->pageTitle.="Dashboard";
        $data['title'] =$this->pageTitle;
    	return view('admin.home',$data);
    }
    public function adminAllProduct(){
      $products = Product::orderby('id', 'desc')->get();
      return view('admin.productList', compact('products'));
    }
    public function adminSingleProduct($id){
      $product = Product::find($id);
      return view('admin.productSingle', compact('product'));
    }
    public function adminApproveProd($id){
      $product = Product::find($id);
      if($product->dpstatus == 1){
        $product->dpstatus = 0;
        $product->save();
      }else{
        $product->dpstatus = 1;
        $product->save();
      }
      return redirect()->back();
    }
    function productCategory(){
    	$this->pageTitle.="Product Category";
        $data['title'] =$this->pageTitle;
        $data['products'] = Category::all();
        return view('admin.product-category',$data);
    } 
    
    function productSubCategories(){
    	$this->pageTitle .="Product Sub Category";
    	$data['title'] = $this->pageTitle;
    	$data['product_categories'] = Category::all();
      $data['products'] = Child::all();
      foreach ($data['products'] as $key => $value) {
       // echo  $value->products->category_name;
      }
        return view('admin.sub-product-category',$data);
    }
    function productSubSubCategories(){
       $this->pageTitle .="Product Sub Sub Category";
       $data['title'] = $this->pageTitle;
       $data['product_sub_category'] = Child::all();
       $data['products'] = Nephew::all();
       return view('admin.sub-sub-product-category',$data);
    }
    function storeProductCategories(Request $r){
       $this->validate($r,[
        'name'=>'required|unique:categories'
       ]); 
       
       $category = new Category;
       $category->name = $r->name;
       $category->save();
       return redirect()->back();
    }
    function storeProductSubCategories(Request $r){
        $this->validate($r,[
         'product_category_id'=>'required',
         'name'=>'required|unique:children'
       ]); 
      
      $child = new Child();
      $child->category_id = $r->product_category_id;
      $child->name = $r->name;
      $child->save();
      return redirect()->back();
    }
    function storeProductSubSubCategories(Request $r){
       // dd($r);
       $this->validate($r,[
        'product_sub_category_id'=>'required',
        'name'=>'required'
       ]); 
      $nephew = new Nephew();
      $nephew->child_id = $r->product_sub_category_id;
      $nephew->name = $r->name;
      $nephew->save();

       return redirect()->back();
    }
    function editCategory($id, $type){
        if($type == 'category'){
          $category = Category::find($id);
        }
        if($type == 'child'){
          $category = Child::find($id);
        }
        if($type == 'niphew'){
          $category = Nephew::find($id);
        }
        return view('admin.edit-categories', compact('category', 'type'));       
    }
    public function postCategoryEdit(Request $r, $id){
      $this->validate($r,[
        'category'=>'required|string',
        'type'=>'required|string'
       ]);

      if($r->type == 'category'){
        $category = Category::find($id);
        $category->name = $r->category;
        $category->save();        
      }
      if($r->type == 'child'){
        $category = Child::find($id);
        $category->name = $r->category;
        $category->save();        
      }
      if($r->type == 'niphew'){
        $category = Nephew::find($id);
        $category->name = $r->category;
        $category->save();        
      }

      return redirect()->back();
    }
   
    public function changePmntStatus($id){
      $order = Order::find($id);
      $profit = $order->subtotal - $order->discount;
      $did = $order->did;
      if($order->didpaid != 1){
          $headers = [
                      'Content-Type' => 'application/json',
                      'Authorization' => 'Bearer '.Auth::user()->password,
                    ];
          $client = new Client([
              'headers' => $headers
          ]);
          $response = $client->POST('http://api.unistag.com/public/api/devide-income', [
              'form_params' => [
                  'dpid' => $did,
                  'profit' => $profit
              ]
          ]);
          if($response->getStatusCode() == 200){
            $order->didpaid = 1;
            $order->save();
          }
      }
      return redirect()->back();
    }
}
