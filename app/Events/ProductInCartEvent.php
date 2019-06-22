<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ProductInCartEvent
{
   use Dispatchable, SerializesModels;

   public $product_id;
   public $quantity;

   public function __construct ( $product_id, $quantity )
   {
      $this->product_id = $product_id;
      $this->quantity = $quantity;
   }
}
