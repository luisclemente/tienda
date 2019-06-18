<?php

use App\Product;
use App\Provider;
use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
   public function run ()
   {
      factory ( Provider::class, 3 )->create ()
         ->each ( function ( Provider $provider ) {
            $products = Product::all ()->whereBetween ( 'id', [ 1, 5 ] );
            foreach ( $products as $product )
            {
               $provider->products ()->attach ( $product->id, [
                  'price'    => rand ( 10, 200 ),
                  'discount' => Arr::random ( [ 25, 50, 75 ] )
               ] );
            }
         } );
   }
}
