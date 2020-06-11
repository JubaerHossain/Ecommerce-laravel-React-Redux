<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Nephew;
use App\Child;
use App\Order;
use App\Merchant;
use App\Withdraw;
use Image;
use File;
use Auth;
class MerchantDashboardController extends Controller
{	
    function __construct(){
      $this->middleware('merchant');
    }
   
    public function convert_to_slug($text){
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);
      // trim
      $text = trim($text);
      // remove duplicated - symbols
      $text = preg_replace('~-+~', '-', $text);
      // lowercase
      $text = strtolower($text);
      if (empty($text)) {
        return 'n-a';
      }
      return $text;
    }
}
