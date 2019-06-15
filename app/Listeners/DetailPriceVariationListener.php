<?php

namespace App\Listeners;

use Carbon\Carbon;

class DetailPriceVariationListener
{
   public function handle ( $event )
   {
      $lastWeek = Carbon::now ()->subDays ( 7 );
      $product = $event->product;

      foreach ( $product->cart_details as $detail )
      {
         if ($detail->cart->status === 'active') {
            if ( $product->price > $detail->price && $product->price_changed > $lastWeek )
               return;

            $detail->price = $product->price;
            $detail->save ();
         }

      }
   }
}
