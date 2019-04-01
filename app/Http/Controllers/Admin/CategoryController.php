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

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create ()
   {
      return view ( 'admin.categories.create' );
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    *
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store ( CategoryRequest $request )
   {
      $category = Category::create ( $request->all () );

      if ( $request->hasFile ( 'image' ) ) {
         // guardar la imagen en nuestro proyecto
         $file = $request->file ( 'image' );
         $path = public_path () . '/images/categories'; // ruta absoluta a public + ruta directorio imágenes
         $fileName = uniqid () . '-' . $file->getClientOriginalName (); // id único + nombre del archivo q sube el usuario
         $moved = $file->move ( $path, $fileName );

         // update category
         if ( $moved ) {
            $category->image = $fileName;
            $category->save (); // UPDATE
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
            $saved = $category->save (); // UPDATE

            if ( $saved )
               File::delete ( $previousPath );
         }
      }
      return redirect ( '/admin/categories' );
   }

   /**
    * @throws \Exception
    */
   public function destroy ( Category $category )
   {
      $category->products ()->update ( [ 'category_id' => null ] );
      $category->delete ();
      return back ();
   }
}
