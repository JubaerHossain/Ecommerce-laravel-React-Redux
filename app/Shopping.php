<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Shopping extends Model
 
{
 
   //
   protected $connection = 'mysql2';
   protected $table = 'shopping';
 
   protected $fillable = ['userid','selfshopping','lv1shopping','lv2shopping','lv3shopping','lv4shopping','lv5shopping','lv6shopping','lv7shopping','lv8shopping','lv9shopping','lv10shopping'];
 
}