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

      factory ( Category::class, 5 )->create ()
         ->each ( function ( $category ) {
            $products = factory ( Product::class, 20 )->make ();
            $category->products ()->saveMany ( $products );

            $products->each ( function ( $product ) {
               $images = factory ( ProductImage::class, 5 )->make ();
               $product->images ()->saveMany ( $images );
            } );
         } );


   } // run

} // class
