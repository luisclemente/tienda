<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
   public function show ( Category $category )
   {
      $products = $category->products ()->paginate ( 9 );
      return view ( 'categories.show', compact ( 'category', 'products' ) );
   }

}
