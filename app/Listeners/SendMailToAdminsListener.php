<?php

namespace App\Listeners;

use App\Mail\MinimumStockMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class SendMailToAdminsListener
{
   public function handle ( $event )
   {
      $admins = User::all ()->where ( 'admin', true );

      foreach ( $event->products_minimum_stock as $product )
      {
         foreach ( $admins as $admin )
         {
            Mail::to ( $admin )->send ( new MinimumStockMail( $product ) );
         }
      }

   }
}
