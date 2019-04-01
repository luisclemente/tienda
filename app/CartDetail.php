<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CartDetail extends Model
{
   protected $fillable = [ 'product_id', 'quantity' ];

   public function product ()
   {
      return $this->belongsTo ( Product::class );
   }

   public function cart ()
   {
      return $this->belongsTo ( Cart::class );
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

   public function price ()
   {
    //  $lastWeek = date ( "Y-m-d H:i:s", strtotime ( '-7 days' ) );
      $lastWeek =  Carbon::now ()->subDays (7);

      if ( $this->product->price > $this->price ) {
         if ( $this->created_at > $lastWeek )
            return $this->price;

         $this->price = $this->product->price;
         $this->save ();
         return $this->price;

      }
      if ( $this->product->price <= $this->price ) {
         $this->price = $this->product->price;
         $this->save ();

         return $this->price;
      }
   }

}
