<?php

use App\Category;
use App\Product;
use App\ProductImage;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
   public function run ()
   {
      factory ( Category::class, 1 )->create ( [ 'name' => 'General' ] );

      // API
      factory ( Product::class, 20 )->create ()->each
      (
         function ( $product )
         {
            $images = factory ( ProductImage::class, 5 )->create ( [ 'product_id' => $product->id ] );
            $product->images ()->saveMany ( $images );
         }
      );

      factory ( Category::class, 5 )->create ()->each
      (
         function ( $category )
         {
            $products = Product::all ()->whereBetween ( 'id', [ rand ( 1, 5 ), rand ( 6, 20 ) ] );
            $category->products ()->sync ( $products );
         }
      );


   } // run

} // class
