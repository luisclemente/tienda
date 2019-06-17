<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up ()
   {
      Schema::create ( 'products', function ( Blueprint $table ) {

         $table->bigIncrements ( 'id' );

         $table->unsignedBigInteger ('category_id')->nullable();
         $table->foreign ('category_id')->references('id')->on('categories');

         $table->string ( 'name' );
         $table->mediumText ( 'description' );
         $table->text ( 'long_description' )->nullable();
         $table->float ( 'price' );
         $table->integer ( 'stock' );
         $table->integer ( 'minimum_stock' )->nullable();
         $table->timestamp ('price_changed')->nullable();
         $table->float('previous_price')->nullable();

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
      Schema::dropIfExists ( 'products' );
   }
}
