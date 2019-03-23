<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up ()
   {
      Schema::create ( 'product_images', function ( Blueprint $table ) {
         $table->bigIncrements ( 'id' );

         $table->unsignedBigInteger ( 'product_id' );
         $table->foreign ( 'product_id' )->references ( 'id' )->on ( 'products' )
            ->onDelete ( 'cascade' )
            ->onUpdate ( 'cascade' );

         $table->string ( 'image' );
         // Este campo indica si será una imagen destacada, por defecto no lo será, será el usuario el que la destaque
         $table->boolean ( 'featured' )->default ( false );

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
      Schema::dropIfExists ( 'product_images' );
   }
}
