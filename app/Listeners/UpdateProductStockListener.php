<?php

namespace App\Listeners;

use App\Events\ProductInCartEvent;
use App\Product;

class UpdateProductStockListener
{
   public function handle ( ProductInCartEvent $event )
   {
      $product = Product::find ( $event->product_id );
      $product->stock -= $event->quantity;
      $product->save ();
   }
}
