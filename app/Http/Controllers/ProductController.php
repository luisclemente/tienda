<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function show ( Product $product )
   {
      $contador = 0;
      $imagesLeft = collect ();
      $imagesRight = collect ();
      foreach ( $product->images as $key => $image ) {
         $key % 2 ? $imagesRight->push ( $image ) : $imagesLeft->push ( $image );
      }
      return view ( 'products.show', compact ( 'product', 'imagesLeft', 'imagesRight', 'contador' ) );
   }
}

