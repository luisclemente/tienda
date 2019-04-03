<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage (\Request $request, $entity)
    {
       if ( $request->hasFile ( 'image' ) ) {
          // guardar la imagen en nuestro proyecto
          $file = $request->file ( 'image' );
          $path = public_path () . '/images/categories'; // ruta absoluta a public + ruta directorio imágenes
          $fileName = uniqid () . '-' . $file->getClientOriginalName (); // id único + nombre del archivo q sube el usuario
          $moved = $file->move ( $path, $fileName );

          // update category
          if ( $moved ) {
           //  $category->image = $fileName;
          //   $category->save (); // UPDATE
          }
       }
    }
   public function setLanguage ( $language )
   {
      if ( array_key_exists ( $language, config ( 'languages' ) ) )
      {
         session ()->put ( 'applocale', $language );
      }
      return back();
   }
}
