<?php

namespace App\Events;

use App\Cart;
use App\User;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CartWasOrderedEvent
{
   use Dispatchable, InteractsWithSockets, SerializesModels;

   public $user;
   public $cart;

   public function __construct ( User $user, Cart $cart )
   {
      $this->user = $user;
      $this->cart = $cart;
   }

}
