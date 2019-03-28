<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up ()
   {
      Schema::create ( 'carts', function ( Blueprint $table ) {
         $table->bigIncrements ( 'id' );

         $table->date ( 'order_date' )->nullable (); // Cuando quiere el usuario recibir el pedido
         $table->date ( 'arrived_date' )->nullable (); // Cuando ha llegado el pedido
         $table->string ( 'status' ); // Active, Pending, Approved, Cancelled, Finished

         $table->unsignedBigInteger ( 'user_id' );
         $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' );

         $table->timestamps ();
      } );
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down ()
   {
      Schema::dropIfExists ( 'carts' );
   }
}
