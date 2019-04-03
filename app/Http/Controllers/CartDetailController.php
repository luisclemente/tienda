<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use App\Events\ProductWasAddedToCart;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{

   public function store ( Request $request )
   {
      if ( $request->product_stock == 0 ) {
         return back ()->with ( 'status', 'No quedan unidades en stock' );
      }
      $breakStock = false;
      $unidadesPedido = $request->quantity;
      $unidadesPosibles = $request->product_stock - $request->quantity;
      if ($unidadesPosibles < 0){
         $unidadesPedido = $request->product_stock;
         $breakStock = true;
      }

      $cartDetail = new CartDetail();
//      user->carts es un accesor que crea un nuevo carrito si no existe y lo devuelve
      $cartDetail->cart_id = auth ()->user ()->cart->id;
      $cartDetail->product_id = $request->product_id;
      $cartDetail->quantity = $unidadesPedido;
      $cartDetail->price = $request->price;
      $cartDetail->subtotal = $request->price * $request->quantity;

      $cartDetail->save ();

      ProductWasAddedToCart::dispatch ( $request->product_id, $unidadesPedido );

      return $breakStock
         ? back ()->with ( 'status', 'Stock insuficiente. Se han añadido al carrito ' . $unidadesPedido . ' unidades')
         : back ()->with ( 'status', 'Producto añadido al carrito' );
   }

   /*
    * Actualiza un detalle del carrito con los botones de control del carrito
    */
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

   /*
    * Actualiza un detalle del carrito con una ventana modal
    */
   public function updateWithModal ( Request $request )
   {
      $detail = CartDetail::find ( $request->detail_id );

      $quantity = $request->quantity - $detail->quantity; // Si positivo añade unidades, si negativo quita.

      $detail->update ( [ 'quantity' => $request->quantity ] );
      ProductWasAddedToCart::dispatch ( $request->product_id, $quantity ); // Dispara evento para actualizar stock*/
      return back ()->with ( 'status', 'Producto actualizado con éxito' );
   }

   public function destroy ( $detail_id )
   {
      /* Para eliminar un detalle necesitamos comprobar que el id del detalle que viene por parámetro pertenece al carts
         del usuario autenticado ya que puede haber sido manipulado manualmente por otro usuario en el html de su
         carrito de compras */

      $cartDetail = CartDetail::find ( $detail_id );

      if ( $cartDetail->cart_id == auth ()->user ()->cart->id ) {
         $cartDetail->delete ();
      }

      return back ()->with ( 'status', 'El producto se ha eliminado correctamente' );
   }
}
