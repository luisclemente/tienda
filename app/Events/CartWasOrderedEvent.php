<?php

namespace App\Events;

use App\Cart;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

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
