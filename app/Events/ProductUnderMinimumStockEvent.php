<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ProductUnderMinimumStockEvent
{
   use Dispatchable, InteractsWithSockets, SerializesModels;

   public $products_minimum_stock;

   public function __construct ( $products_minimum_stock )
   {
      $this->products_minimum_stock = $products_minimum_stock;
   }

}
