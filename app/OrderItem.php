<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
   protected $fillable = [ 'price', 'quantity', 'product_id', 'order_id' ];
   public $timestamps = false;

   public function order ()
   {
      return $this->belongsTo ( Order::class );
   }

   public function product ()
   {
      return $this->belongsTo ( Product::class );
   }
}
