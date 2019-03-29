<?php

namespace App\Http\Controllers;

use App\CartDetail;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
   public function store ( Request $request )
   {
      $cartDetail = new CartDetail();
//      user->cart es un accesor que crea un nuevo carrito si no existe y lo devuelve
      $cartDetail->cart_id = auth ()->user ()->cart->id;
      $cartDetail->product_id = $request->product_id;
      $cartDetail->quantity = $request->quantity;
      $cartDetail->save ();

      return back ()->with ( 'status', 'Producto añadido al carrito' );
   }

   public function update ( Request $request, $cartDetail_id )
   {
      $cartDetail = CartDetail::find ( $cartDetail_id );

      if ( $request->has ( 'anadir' ) ) {
         $cartDetail->addUnitToDetail ();
         return back ()->with ( 'status', 'Unidad añadida al carrito' );
      }
      if ( $request->has ( 'quitar' ) ) {
         $cartDetail->removeUnitToDetail ();
         return back ()->with ( 'status', 'Unidad eliminada del carrito' );
      }



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
