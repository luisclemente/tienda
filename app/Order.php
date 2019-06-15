<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   //protected $table = 'orders';
   protected $fillable = [ 'subtotal', 'shipping', 'user_id' ];

   public function user ()
   {
      return $this->belongsTo ( User::class );
   }

   public function order_items ()
   {
      return $this->hasMany ( OrderItem::class );
   }
}
