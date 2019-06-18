<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

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
      if ( is_null ( $request->stock ) )
         $request->merge ( [ 'stock' => 0 ] );

      Product::create ( $request->all () );
      return redirect ()->route ( 'admin_products_index' );
   }

   public function edit ( Product $product )
   {
      $categories = Category::orderBy ( 'name' )->get ();
      return view ( 'admin.products.edit', compact ( 'product', 'categories' ) );
   }

   public function update ( ProductRequest $request, Product $product )
   {
      dd ( $request );
      $product->priceVariation ( $request, $product )->update ( $request->all () );
      return redirect ( $request->previous_url );
   }

   public function purchase ( Request $request )
   {
      $product = Product::find ( $request->productid );
      $product->update ( [ 'stock' => $product->stock + $request->quantity ] );
      return back ();
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
