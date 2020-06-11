<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Order;
use App\Upline;
use App\Income;
use Auth;
use App\Shopping;
use App\Message;
use App\UplineLevel;
use Validator;

class OrderController extends Controller
{
    function apiOrderSubmit(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'merchant_id' => 'sometimes|nullable|integer',
            'user_id' => 'sometimes|nullable|required|integer',
            'did' => 'sometimes|nullable|integer',
            'email' => 'sometimes|nullable|string',
            'phone' => 'required|string',
            'products' => 'required|array',
            'address' => 'required|array',
            'subtotal' => 'required|integer',
            'shipping' => 'required|integer',
            'discount' => 'sometimes|nullable|integer',
            'total' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        if ($request->aff_id) {

            $aff=\App\User::where('dpid', $request->aff_id)->first()->id;
        }else {
            $aff=0;
        }
        $order = new Order;
        $order->merchant_id = $request->merchant_id;
        $order->user_id = $request->user_id;
        $order->did = $request->did;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->products = json_encode($request->products);
        $order->address = json_encode($request->address);
        $order->subtotal = $request->subtotal;
        $order->shipping = $request->shipping;
        $order->discount = $request->discount;
        $order->total = $request->total;
        $order->aff_id = $aff;
        $order->save();
        return response()->json(['success' => 'Success', 'order' => $order], 200);
    }
   	function orders(){
        $orders = Order::where('merchant_id', Auth::user()->marchant->id)->orderby('id', 'desc')->get();
           // dd(Auth::user()->marchent->id);
           $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
	    return view('merchant.order', compact('orders','messg'));
    }
    function orderEdit($id){
        $order = Order::find($id);
        $items = json_decode($order->products);
        $cartProducts = $items->items;
        $address = json_decode($order->address);
        $messg=Message::where('s_status',0)->where('receiver',Auth::user()->id)->get();
	    return view('merchant.orderEdit', compact('order','messg', 'cartProducts', 'address'));
    }
    function changeStatus($id){
        $order = Order::find($id);
        $user=\App\User::find($order->aff_id);
        $products = json_decode($order->products);
        if ($order->aff_id && $user->dpid) {
            $upline = Upline::where('user_id', $user->dpid)->first();
            
            if($upline){
                foreach($products->items as $product){
                    $profit = $product->price - $product->v_price;
                    $profit = $profit * $product->qty;
                    $this->devideIncomeId($profit, $user->dpid);
                }
            }
            
        }
        if($order->did){
            $upline = Upline::where('user_id', $order->did)->first();
            
            if($upline){
                foreach($products->items as $product){
                    $profit = $product->price - $product->v_price;
                    $profit = $profit * $product->qty;

                    $this->devideIncomeId($profit, $order->did);
                }
            }else{
                return response()->json(['error' => 'No Upline Found'], 400);
            }
        }
        $order->status = 1;
        $order->save();
	    return redirect()->back();
    } 
    public function devideIncomeId($amm, $id){
        // $levels = $this->getUpline($id);
        $levels = Upline::where('user_id', $id)->first();
        if(!$levels){
            return false;
        }
        $self = ($amm * 20)/100;
        $la = ($amm * 5)/100;
        $lb = ($amm * 1)/100;
        $lc = ($amm * .5)/100;

        $income = Income::firstOrCreate(array('dpid' => $id));
        $income->self += number_format($self, 2);
        $income->save();


        if($levels->a != 0){
            $shp1 = Income::firstOrCreate(array('dpid' => $levels->a));
            $shp1->a += number_format($la, 6);
            $shp1->save();
            if($levels->b != 0){
                $shp2 = Income::firstOrCreate(array('dpid' => $levels->b));
                $shp2->b += number_format($lb, 6);
                $shp2->save();
                if($levels->c != 0){
                    $shp3 = Income::firstOrCreate(array('dpid' => $levels->c));
                    $shp3->c += number_format($lb, 6);
                    $shp3->save();
                    if($levels->d != 0){
                        $shp4 = Income::firstOrCreate(array('dpid' => $levels->d));
                        $shp4->d += number_format($lb, 6);
                        $shp4->save();
                        if($levels->e != 0){
                            $shp5 = Income::firstOrCreate(array('dpid' => $levels->e));
                            $shp5->f += number_format($lb, 6);
                            $shp5->save();
                            if($levels->f != 0){
                                $shp6 = Income::firstOrCreate(array('dpid' => $levels->f));
                                $shp6->f += number_format($lc, 6);
                                $shp6->save();
                                if($levels->g != 0){
                                    $shp7 = Income::firstOrCreate(array('dpid' => $levels->g));
                                    $shp7->g += number_format($lc, 6);
                                    $shp7->save();
                                }
                            }
                        }
                    }
                }
            }
        }
        return true;
    }
    public function getUpline($id){
        if($upline = Upline::where('dpid', $id)->first()){
            return $upline;
        }else{
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->GET('http://dlpbd.com/api/get-upline-all/'.$id);

            if($response->getStatusCode() == 200){
                $resp = $response->getBody();
                $obj = json_decode($resp);
                $upline = new Upline;
                    $upline->user_id = $request->dpid;
                    $upline->a = $obj->uplines[0];
                    $upline->b = $obj->uplines[1];
                    $upline->c = $obj->uplines[2];
                    $upline->d = $obj->uplines[3];
                    $upline->e = $obj->uplines[4];
                    $upline->f = $obj->uplines[5];
                    $upline->g = $obj->uplines[6];
                    $upline->save();

                return $upline;
            }else{
                return false;
            }
        }
    }
}
