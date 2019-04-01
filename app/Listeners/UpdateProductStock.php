<?php

namespace App\Listeners;

use App\Events\ProductWasAddedToCart;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProductStock
{
   /**
    * Handle the event.
    *
    * @param  ProductWasAddedToCart $event
    * @return void
    */
   public function handle ( ProductWasAddedToCart $event )
   {
      $product = Product::find ( $event->product_id );

      if ( $event->quantity > 0 ) // Si el usario ha modificado el carrito añadiendo unidades del detalle
         $product->stock = $product->stock - $event->quantity; // Sustraemos las unidades al stock
      elseif ( $event->quantity < 0 ) // Si el usario ha modificado el carrito quitando unidades al detalle
         $product->stock = $product->stock - $event->quantity; // Reponemos las unidades al stock

      $product->save ();
   }
}
