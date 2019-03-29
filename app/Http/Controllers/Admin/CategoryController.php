<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
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
   public function store ( Request $request )
   {
      $this->validate ( $request, Category::$rules, Category::$messages );
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
   public function edit ( Category $category )
   {
      return view ( 'admin.categories.edit', compact ( 'category' ) );
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param Category $category
    * @return \Illuminate\Http\Response
    * @throws \Illuminate\Validation\ValidationException
    */
   public function update ( Request $request, Category $category )
   {
      $this->validate ( $request, Category::$rules, Category::$messages );
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
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    * @throws \Exception
    */
   public function destroy ( Category $category )
   {
      $category->products ()->update ( [ 'category_id' => null ] );
      $category->delete ();
      return back ();
   }
}
