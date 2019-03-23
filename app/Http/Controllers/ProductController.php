<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

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

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create ()
   {
      return view ( 'admin.products.create' );
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store ( Request $request )
   {
      // dd($request->all());
      $product = new Product();
      $product->name = $request->input ( 'name' );
      $product->description = $request->input ( 'description' );
      $product->price = $request->input ( 'price' );
      $product->long_description = $request->input ( 'long_description' );

      $product->save ();

      return redirect ( '/admin/products' );
   }

   /**
    * Display the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function show ( $id )
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function edit ( $id )
   {
      $product = Product::find ( $id );
      return view ( 'admin.products.edit', compact ( 'product' ) );
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function update ( Request $request, $id )
   {
      $product = Product::find ( $id );
      $product->name = $request->input ( 'name' );
      $product->description = $request->input ( 'description' );
      $product->price = $request->input ( 'price' );
      $product->long_description = $request->input ( 'long_description' );

      $product->save ();

      return redirect ( '/admin/products' );
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy ( $id )
   {
      $product = Product::find ( $id );
      $product->delete ();

      return back ();
   }
}