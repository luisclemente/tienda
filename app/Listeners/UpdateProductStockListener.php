<?php

namespace App\Listeners;

use App\Events\ProductInCartEvent;
use App\Product;

class UpdateProductStockListener
{
   /**
    * Handle the event.
    *
    * @param  ProductInCartEvent $event
    * @return void
    */
   public function handle ( ProductInCartEvent $event )
   {
      $product = Product::find ( $event->product_id );

      if ( $event->quantity > 0 ) // user añade unidades
         $product->stock -= $event->quantity; // Sustraemos del stock
      elseif ( $event->quantity < 0 ) // user quita unidades
         $product->stock -= $event->quantity; // Sumamos al stock

      $product->save ();
   }
}
