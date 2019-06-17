<?php

namespace App\Mail;

use App\Cart;
use App\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
   use Queueable, SerializesModels;

   private $user;
   private $cart;
   private $pdf;

   /**
    * Create a new message instance.
    *
    * @return void
    */
   public function __construct ( User $user, Cart $cart, PDF $pdf )
   {
      $this->user = $user;
      $this->cart = $cart;
      $this->pdf = $pdf;
   }

   public function build ()
   {
      return $this
         ->markdown ( 'emails.receipt' )
         ->with ( 'user', $this->user )
         ->with ( 'cart', $this->cart )
         ->attachData ( $this->pdf->output (), 'Tu factura.pdf' )
         ->subject ( 'Nuevo Pedido de Tienda Luis' );
   }
}
