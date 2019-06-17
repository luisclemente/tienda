<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Carbon\Carbon;

class CartController extends Controller
{
   public function update ()
   {
      $user = User::find ( auth ()->id () );
      $cart = $user->cart;
      $cart->status = 'pending';
      $cart->order_date = Carbon::now ();
      $cart->save ();

      return back ()->with ( 'status', 'Tu pedido ha sido registrado. Te contactaremos pronto vía email' );
   }

   public function ordered_carts ()
   {
      return view ( 'carts.ordered_carts' );
   }

   public function show ( Cart $cart )
   {
      return view ( 'admin.clients.cart_details', compact ( 'cart' ) );
   }
}
