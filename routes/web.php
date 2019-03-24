<?php

use App\Product;
use App\Category;
use App\User;
use App\ProductImage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get ( '/', function () {
   $products = Product::all ();
   return view ( 'welcome', compact ( 'products' ) );
} );

Auth::routes ();

Route::get ( '/home', 'HomeController@index' )->name ( 'home' );

Route::middleware ( ['auth', 'admin' ] )->prefix('admin') ->group ( function () {
   Route::get ( '/products', 'ProductController@index' ); // listado
   Route::get ( '/products/create', 'ProductController@create' )->name ( 'create' ); // formulario creación
   Route::post ( '/products', 'ProductController@store' )->name ( 'store' ); // store
   Route::get ( '/products/{id}/edit', 'ProductController@edit' )->name ( 'edit' ); // Formulario edición
   Route::post ( '/products/{id}/update', 'ProductController@update' )->name ( 'update' ); // update
   Route::delete ( '/products/{id}', 'ProductController@destroy' )->name ( 'destroy' ); // Formulario eliminación

   Route::get ( '/products/{id}/images', 'ImageController@index' ); // listado y formulario creación
   Route::post ( '/products/{id}/images', 'ImageController@store' ); // store
   Route::delete ( '/products/{id}/images', 'ImageController@destroy' ); // form eliminar
   Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); // destacar un imagen

} );

