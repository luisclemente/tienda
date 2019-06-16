<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\NewOrder;
use Carbon\Carbon;

class CartController extends Controller
{

   public function update ()
   {
      $user = auth ()->user ();
      $cart = $user->cart;
      $cart->status = 'pending';
      $cart->order_date = Carbon::now ();
      $cart->save ();

     // \Mail::to ( $user )->send ( new NewOrder( $user, $cart ) );

      return back ()->with ( 'status', 'Tu pedido ha sido registrado. Te contactaremos pronto vía email' );
   }

   public function ordered_carts ()
   {
      return view ( 'carts.ordered_carts' );
   }

   public function show (Cart $cart)
   {
      return view ( 'admin.clients.cart_details', compact('cart') );
   }
}
