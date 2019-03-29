<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
   protected $fillable = [ 'product_id', 'quantity' ];

   public function product ()
   {
      return $this->belongsTo ( Product::class );
   }

   public function addUnitToDetail ()
   {
      return $this->update ( [ 'quantity' => $this->quantity + 1 ] );
   }

   public function removeUnitToDetail ()
   {
      if ( $this->quantity > 0 )
         return $this->update ( [ 'quantity' => $this->quantity - 1 ] );
   }
}
