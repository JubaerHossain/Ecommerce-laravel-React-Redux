<?php
namespace App;
class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $merchantId = 0;
    public $totalPrice = 0;
    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->merchantId = $oldCart->merchantId;
        }
    }
    public function add($item, $id, $qty,$size){
        $storedItem = ['qty' => 0, 'price' => $item->dpp, 'item' => $item, 'size' => $size];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $this->totalQty = ($this->totalQty - $storedItem['qty']) + $qty;
        $this->totalPrice = $this->totalPrice - ($storedItem['qty'] * $storedItem['item']['dpp']) + ($item->dpp * $qty);

        //dd($this->totalQty.' '.$this->totalPrice);
        
        $this->merchantId = $item->merchant_id;
        $storedItem['qty'] = $qty;
        $storedItem['price'] = $item->dpp * $qty;
        $this->items[$id] = $storedItem;
    }
    public function removeItem($id){
        $this->totalQty = $this->totalQty - $this->items[$id]['qty'];
        $this->totalPrice = $this->totalPrice - ($this->items[$id]['item']['dpp'] * $this->items[$id]['qty']);
        unset($this->items[$id]);
        return true;
    }
}