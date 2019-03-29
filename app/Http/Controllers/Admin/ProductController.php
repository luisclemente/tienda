<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index ()
   {
      $products = Product::paginate ( 10 );
      return view ( 'admin.products.index', compact ( 'products' ) );
   }

   public function create ()
   {
      $categories = Category::orderBy ( 'name' )->get ();
      return view ( 'admin.products.create', compact ( 'categories' ) );
   }

   /**
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store ( Request $request )
   {
      $this->validate ( $request, Product::$rules, Product::$messages );
      Product::create ( Input::all () ); // Es igual a  Product::create ( $request->all () );
      return redirect ()->route ( 'admin_products_index' );
   }

   public function edit ( Product $product )
   {
      $categories = Category::orderBy ( 'name' )->get ();
      return view ( 'admin.products.edit', compact ( 'product', 'categories' ) );
   }

   /**
    * @throws \Illuminate\Validation\ValidationException
    */
   public function update ( Request $request, Product $product )
   {
      $this->validate ( $request, Product::$rules, Product::$messages );
      $product->update ( $request->all () );
      return redirect ( Input::get ( 'paginate_product_page' ) ); // Redirige al paginate del producto actualizado
   }

   public function destroy ( Product $product )
   {
      $product->delete ();
      return back ();
   }
}
