<?php

namespace App;

use App\Events\ProductWasAddedToCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CartDetail extends Model
{
   protected $fillable = [ 'cart_id', 'product_id', 'quantity', 'price', 'subtotal' ];

   public static function boot ()
   {
      parent::boot ();
      static::saving ( function ( Cartdetail $cartDetail ) {
         if ( ! \App::runningInConsole () )
         {
            $cartDetail->subtotal = $cartDetail->price * $cartDetail->quantity;
         }
      } );

      static::updated ( function ( Cartdetail $cartDetail ) {
         if ( ! \App::runningInConsole () )
         {

         }
      } );

      static::deleted ( function ( Cartdetail $cartDetail ) {
         if ( ! \App::runningInConsole () )
         {
            $cartDetail->product->stock += $cartDetail->quantity;
            $cartDetail->product->save ();
         }
      } );
   }

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

}
