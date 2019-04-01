<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
   /**
    * @return \Illuminate\Http\RedirectResponse
    */
   public function update ()
   {
      $cart = auth ()->user ()->cart;
      $cart->status = 'pending';
      $cart->save ();

      return back ()->with ( 'status', 'Tu pedido ha sido registrado. Te contactaremos pronto vía email' );
   }

   public function ordered_carts ()
   {
      return view ( 'carts.pending' );
   }
}
