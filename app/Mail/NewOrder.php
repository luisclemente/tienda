<?php

namespace App\Mail;

use App\Cart;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
   use Queueable, SerializesModels;

   private $user;
   private $cart;

   public function __construct ( User $user, Cart $cart )
   {
      $this->user = $user;
      $this->cart = $cart;
   }

   public function build ()
   {
      return $this
         ->view ( 'emails.new_order' )
         ->with ( 'user', $this->user )
         ->with ( 'cart', $this->cart )
         ->subject ( 'Nuevo Pedido de Shop' );
   }
}
