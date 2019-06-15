<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use File;
use Illuminate\Http\Request;

class ImageController extends Controller
{
   public function index ( Product $product )
   {
      $images = $product->images ()->orderBy ( 'featured', 'DESC' )->get ();
      return view ( 'admin.products.images.index', compact ( 'product', 'images' ) );
   }

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

   public function destroy ( Request $request )
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

   public function featured ( $product, ProductImage $productImage )
   {
      ProductImage::where ( 'product_id', $product )->update ( [
         'featured' => false
      ] );

      $productImage->featured = true;
      $productImage->save ();

      return back ();
   }
}
