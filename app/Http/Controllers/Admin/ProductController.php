<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
   public function index ()
   {
      $products = Product::sortable ()->paginate ( 10 );
      return view ( 'admin.products.index', compact ( 'products' ) );
   }

   public function create ()
   {
      $categories = Category::orderBy ( 'name' )->get ();
      return view ( 'admin.products.create', compact ( 'categories' ) );
   }

   public function store ( ProductRequest $request )
   {
      Product::create ( Input::all () ); // Input::all() = $request->all ()
      return redirect ()->route ( 'admin_products_index' );
   }

   public function edit ( Product $product )
   {
      $categories = Category::orderBy ( 'name' )->get ();
      return view ( 'admin.products.edit', compact ( 'product', 'categories' ) );
   }

   public function update ( ProductRequest $request, Product $product )
   {
      $product->update ( $request->all () );
      return redirect ( Input::get ( 'paginate_product_page' ) ); // Retorna la página del producto actualizado
   }

   /**
    * @throws \Exception
    */
   public function destroy ( Product $product )
   {
      $product->delete ();
      return back ();
   }

}
