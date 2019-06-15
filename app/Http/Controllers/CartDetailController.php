<?php

namespace App\Http\Controllers;

use App\CartDetail;
use App\Events\ProductInCartEvent;
use App\Product;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
   public function store ( Request $request )
   {
      $possibleUnits = Product::availableUnits ( $request );
      $request->merge ( [ 'quantity' => $possibleUnits ] );

      CartDetail::create ( $request->all () );
      ProductInCartEvent::dispatch ( $request->product_id, $possibleUnits );

      $stockOut = $possibleUnits !== $request->quantity;
      return $stockOut
         ? back ()->with ( 'status', 'Stock insuficiente. Se han añadido al carrito ' . $possibleUnits . ' unidades' )
         : back ()->with ( 'status', 'Producto añadido al carrito' );

   }

   public function update ( Request $request, $cartDetail_id )
   {
      $cartDetail = CartDetail::find ( $cartDetail_id );

      if ( $request->has ( 'anadir' ) && $cartDetail->product->stock > 0 )
      {
         $cartDetail->addUnitToDetail ();
         ProductInCartEvent::dispatch ( $cartDetail->product->id, 1 );
         return back ()->with ( 'status', 'Unidad añadida al carrito' );
      }
      if ( $request->has ( 'quitar' ) )
      {
         $cartDetail->removeUnitToDetail ();
         ProductInCartEvent::dispatch ( $cartDetail->product->id, - 1 );
         return back ()->with ( 'status', 'Unidad eliminada del carrito' );
      }

      return back ()->with ( 'status', 'No quedan unidades de este producto. Pronto repondremos el stock' );
   }

   public function updateWithModal ( Request $request )
   {
      if ( $request->quantity < 1 )
         return back ()->with ( 'status', 'Introduce un número positivo' );

      $detail = CartDetail::find ( $request->detail_id );
      $detail_quantity = $detail->quantity;
      $quantity = $request->quantity - $detail_quantity;

      if ( $request->product_stock == 0 && $quantity > 0 )
         return back ()->with ( 'status', 'No quedan unidades de este producto. Pronto repondremos el stock' );

      $possibleUnits = Product::availableUnits ( $request, $quantity );
      $stockOut = $possibleUnits != $quantity;

      $detail->update ( [ 'quantity' => $detail_quantity + $possibleUnits ] );
      ProductInCartEvent::dispatch ( $request->product_id, $possibleUnits );

      return $stockOut
         ? back ()->with ( 'status', 'Stock insuficiente. Se han añadido al carrito ' . $possibleUnits . ' unidades' )
         : back ()->with ( 'status', 'Producto actualizado con éxito' );

   }

   public function destroy ( CartDetail $detail )
   {
      if ( $detail->cart_id == auth ()->user ()->cart->id )
      {
         $detail->delete ();
      }

      return back ()->with ( 'status', 'El producto se ha eliminado correctamente' );
   }
}
