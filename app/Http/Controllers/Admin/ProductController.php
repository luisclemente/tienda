<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
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
      $categories = Category::orderBy('name')->get();
      return view ( 'admin.products.create', compact('categories') );
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store ( Request $request )
   {
      $this->validate($request, [
         'name' => 'required | min:3',
         'description' => 'required | max:200',
         'price' => 'required | numeric | min:0'
      ], [
         'name.required' => 'El nombre es obligatorio',
         'name.min' => 'El nombre ha de tener al menos 3 caracteres',
         'description.required' => 'La descripción es obligatoria',
         'description.max' => 'La descripción no puede tener más de 200 caracteres',
         'price.required' => 'El precio es obligatorio',
         'price.numeric' => 'El precio debe ser un número',
         'price.min' => 'El precio mínimo es cero'
      ]);

      // dd($request->all());
      $product = new Product();
      $product->name = $request->input ( 'name' );
      $product->description = $request->input ( 'description' );
      $product->price = $request->input ( 'price' );
      $product->long_description = $request->input ( 'long_description' );
      $product->category_id = $request->input ( 'category_id' );

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

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function edit ( $id )
   {
      $categories = Category::orderBy('name')->get();
      $product = Product::find ( $id );
      return view ( 'admin.products.edit', compact ( 'product', 'categories' ) );
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    * @throws \Illuminate\Validation\ValidationException
    */
   public function update ( Request $request, $id )
   {
      $this->validate($request, [
         'name' => 'required | min:3',
         'description' => 'required | max:200',
         'price' => 'required | numeric | min:0'
      ], [
         'name.required' => 'El nombre es obligatorio',
         'name.min' => 'El nombre ha de tener al menos 3 caracteres',
         'description.required' => 'La descripción es obligatoria',
         'description.max' => 'La descripción no puede tener más de 200 caracteres',
         'price.required' => 'El precio es obligatorio',
         'price.numeric' => 'El precio debe ser un número',
         'price.min' => 'El precio mínimo es cero'
      ]);

      $product = Product::find ( $id );
      $product->name = $request->input ( 'name' );
      $product->description = $request->input ( 'description' );
      $product->price = $request->input ( 'price' );
      $product->long_description = $request->input ( 'long_description' );
      $product->category_id = $request->input ( 'category_id' );

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
