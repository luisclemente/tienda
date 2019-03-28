<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use File;
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
      $images = $product->images()->orderBy('featured', 'DESC')->get();
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
      $moved = $file->move ( $path, $fileName );

      // crear 1 registro en la bd
      if ( $moved ) {
         $productImage = new ProductImage();
         $productImage->image = $fileName;
         $productImage->product_id = $id;
         $productImage->save ();
      }
      return back ();

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

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy ( Request $request, $id )
   {
      // Eliminar el archivo
      $productImage = ProductImage::find ( $request->image_id );
      // dd($productImage);
      if ( substr ( $productImage->image, 0, 4 ) === 'http' ) {
         $deleted = true;
      } else {
         $fullPath = public_path () . '/images/products/' . $productImage->image;
         $deleted = File::delete ( $fullPath );
      }
      //Eliminar el registro de la img en la bd
      if ( $deleted ) {
         $productImage->delete ();
      }
      return back ();
   }

   public function select ( $product_id, $image_id )
   {
      // Quitamos el destacado a la imagen que lo tuviera
      ProductImage::where('product_id', $product_id)->update([
         'featured' => false
      ]);

      // Destacamos una imagen del producto
      $productImage = ProductImage::find ( $image_id );
      $productImage->featured = true;
      $productImage->save ();

      return back();
   }
}
