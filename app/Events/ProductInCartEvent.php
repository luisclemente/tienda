<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

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
