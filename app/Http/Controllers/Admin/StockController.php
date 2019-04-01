<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class StockController extends Controller
{
   public function edit ( Product $product )
   {
      return view ( 'admin.products.stock.edit', compact ( 'product' ) );
   }

   public function update ( Request $request, Product $product )
   {
      $product->update ( $request->all () );
      return redirect ( Input::get ( 'paginate_product_page' ) );
   }
}
