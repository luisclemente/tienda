<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
   public function index ()
   {
      $products = Product::Has ( 'providers' )->with ( 'providers' )->paginate ( 3 );
      return view ( 'admin.providers.index', compact ( 'products' ) );
   }

}
