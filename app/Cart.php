<?php

namespace App;

use App\Events\CartWasOrderedEvent;
use App\Events\ProductUnderMinimumStockEvent;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   public static function boot ()
   {
      parent::boot ();

      static::updated ( function ( Cart $cart ) {
         if ( ! \App::runningInConsole () )
         {
            $products_minimum_stock = $cart->products_under_minimum_stock;

            if ( $products_minimum_stock )
               ProductUnderMinimumStockEvent::dispatch ( $products_minimum_stock );

            CartWasOrderedEvent::dispatch ( auth ()->user (), $cart );
         }
      } );
   }

   public function details ()
   {
      return $this->hasMany ( CartDetail::class );
   }

   public function user ()
   {
      return $this->belongsTo ( User::class );
   }

   public function getTotalAttribute ()
   {
      $total = 0;
      foreach ( $this->details as $detail )
      {
         $total += $detail->quantity * $detail->price;
      }
      return $total;
   }

   public function getUserNameAttribute ()
   {
      return $this->user->name;
   }

   public function iva ( $type )
   {
      return round ( $this->total * $type, 2 );
   }

   public function getProductsUnderMinimumStockAttribute ()
   {
      $products_minimum_stock = [];

      foreach ( $this->details as $detail )
      {
         if ( $detail->product->stock < $detail->product->minimum_stock )
         {
            array_push ( $products_minimum_stock, $detail->product );
         }
      }

      return $products_minimum_stock;
   }
}
