<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   public function details ()
   {
      return $this->hasMany ( CartDetail::class );
   }
   /*
    * Evento para descontar unidades al stock cuando el usuario realiza el pedido
    */
   protected static function boot ()
   {
      parent::boot ();
      static::updated ( function ( Cart $cart ) {

         if ( ! \App::runningInConsole () ) {
            foreach ( $cart->details as $detail ) {
               $product = Product::find ( $detail->product->id );
               $product->stock = $product->stock - $detail->quantity;
               $product->save ();
            }
         }

      } );
   }
}
