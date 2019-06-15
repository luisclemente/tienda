<?php

namespace App\Events;

use App\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class ProductPriceWasChangedEvent
{
   use Dispatchable, InteractsWithSockets, SerializesModels;

   public $product;

   public function __construct ( Product $product )
   {
      $this->product = $product;
   }

}