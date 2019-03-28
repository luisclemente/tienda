<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToUsersTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up ()
   {
      Schema::table ( 'users', function ( Blueprint $table ) {
         $table->string ('phone')->nullable ()->after ('email');
         $table->string ('address')->nullable ()->after ('phone');
         $table->string ('user_name')->after ('address');
      } );


   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down ()
   {
      Schema::table ( 'users', function ( Blueprint $table ) {
         $table->dropColumn ([
            'phone', 'address'
         ]);
      } );
   }
}
