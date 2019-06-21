<?php

namespace App\Listeners;

use App\Mail\InvoiceMail;
use App\User;
use Illuminate\Support\Facades\App;

class SendMailToClientAndAdminsListener
{
   public function handle ( $event )
   {
      $user_admins = User::all ()->where ( 'admin', true );
      $pdf = App::make ( 'dompdf.wrapper' );

      $pdf->loadView ( 'invoices.receipt', [ 'user' => $event->user, 'cart' => $event->cart ] );
      \Mail::to ( $event->user )->send ( new InvoiceMail( $event->user, $event->cart, $pdf ) );

      foreach ( $user_admins as $admin )
      {
         \Mail::to ( $admin )->send ( new InvoiceMail( $event->user, $event->cart, $pdf ) );
      }
   }
}
