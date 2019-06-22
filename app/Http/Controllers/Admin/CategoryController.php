<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use File;

class CategoryController extends Controller
{
   public function index ()
   {
      $categories = Category::orderBy ( 'name' )->paginate ( 10 );
      return view ( 'admin.categories.index', compact ( 'categories' ) );
   }

   public function create ()
   {
      return view ( 'admin.categories.create' );
   }

   public function store ( CategoryRequest $request )
   {
      $category = Category::create ( $request->all () );

      if ( $request->hasFile ( 'image' ) ) {
         // guardar la imagen en nuestro proyecto
         $file = $request->file ( 'image' );
         $path = public_path () . '/images/categories'; // ruta absoluta a public + ruta directorio imágenes
         $fileName = uniqid () . '-' . $file->getClientOriginalName (); // id único + nombre del archivo q sube el usuario
         $moved = $file->move ( $path, $fileName );

         if ( $moved ) {
            $category->image = $fileName;
            $category->save ();
         }
      }
      return redirect ()->route ('admin_categories_index');
   }

   public function edit ( Category $category )
   {
      return view ( 'admin.categories.edit', compact ( 'category' ) );
   }

   public function update ( CategoryRequest $request, Category $category )
   {
      $category->update ( $request->all () );

      if ( $request->hasFile ( 'image' ) ) {
         // guardar la imagen en nuestro proyecto
         $file = $request->file ( 'image' );
         $path = public_path () . '/images/categories'; // ruta absoluta a public + ruta directorio imágenes
         $fileName = uniqid () . '-' . $file->getClientOriginalName (); // id único + nombre del archivo q sube el usuario
         $moved = $file->move ( $path, $fileName );

         // update category
         if ( $moved ) {
            $previousPath = $path . '/' . $category->image;

            $category->image = $fileName;
            $saved = $category->save ();

            if ( $saved )
               File::delete ( $previousPath );
         }
      }
      return redirect ( '/admin/categories' );
   }

   /** @throws \Exception */
   public function destroy ( Category $category )
   {
      $category->products ()->update ( [ 'category_id' => null ] );
      $category->delete ();
      return back ();
   }
}
