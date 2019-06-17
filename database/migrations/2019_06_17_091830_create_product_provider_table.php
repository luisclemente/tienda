<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_provider', function (Blueprint $table) {

           $table->unsignedBigInteger ('product_id');
           $table->foreign ('product_id')->references('id')->on('products');

           $table->unsignedBigInteger ('provider_id');
           $table->foreign ('provider_id')->references('id')->on('providers');

           $table->integer ('price')->default(0);
           $table->integer ('discount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_provider');
    }
}
