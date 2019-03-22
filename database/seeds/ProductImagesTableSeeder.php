<?php

use App\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run ()
   {
      factory ( ProductImage::class, 200 )->create ();
   }
}
