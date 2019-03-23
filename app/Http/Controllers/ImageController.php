<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index ( $id )
   {
      $product = Product::find ( $id );
      $images = $product->images;
      return view ( 'admin.products.images.index', compact ( 'product', 'images' ) );
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create ()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store ( Request $request, $id )
   {
      // guardar la imagen en nuestro proyecto
      $file = $request->file ( 'photo' );
      $path = public_path () . '/images/products'; // ruta absoluta a public + ruta directorio imágenes
      $fileName = uniqid () . $file->getClientOriginalName (); // id único + nombre del archivo q sube el usuario
      $file->move ( $path, $fileName );

      // crear 1 registro en la bd
      $productImage = new ProductImage();
      $productImage->image = $fileName;
      $productImage->product_id = $id;
      $productImage->save();

      return back();

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
      //
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
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy ( $id )
   {
      //
   }
}
