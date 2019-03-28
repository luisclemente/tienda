<?php

namespace App\Http\Controllers;

use App\CartDetail;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
   public function store ( Request $request )
   {
      $carDetail = new CartDetail();

      $carDetail->cart_id = auth ()->user ()->cart->id; // cart es un accesor en User
      $carDetail->product_id = $request->product_id;
      $carDetail->quantity = $request->quantity;

      $carDetail->save ();
      return back ()->with ('status', 'Producto añadido al carrito');
   }

   public function destroy ( $detail_id )
   {
      /* Para eliminar un detalle necesitamos comprobar que el id del detalle que viene por parámetro pertenece al cart
         del usuario autenticado ya que puede haber sido manipulado manualmente por otro usuario en el html de su
         carrito de compras */

      $cartDetail = CartDetail::find ( $detail_id );

      if ( $cartDetail->cart_id == auth ()->user ()->cart->id ) {
         $cartDetail->delete ();
      }

      $notificacion = 'El producto se ha eliminado del carrito';
      return back ()->with ( 'status', 'El producto se ha eliminado correctamente' );
   }
}
