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
   $categories = Category::has ( 'products' )->get ();
   return view ( 'welcome', compact ( 'categories' ) );
} );

Auth::routes ();

Route::get ( '/search', 'SearchController@show' );
Route::get ( '/products/json', 'SearchController@data' );

Route::get ( '/home', 'HomeController@index' )->name ( 'home' );
Route::get ( '/products/{product}', 'ProductController@show' ); // LLamada en welcome.blade (nombre del producto)
Route::get ( '/categories/{category}', 'CategoryController@show' );

Route::post ( '/cart', 'CartDetailController@store' );
Route::delete ( '/cart/{detail}', 'CartDetailController@destroy' );

Route::post ( '/order', 'CartController@update' );

Route::middleware ( [ 'auth', 'admin' ] )->prefix ( 'admin' )->namespace ( 'Admin' )->group ( function () {
   Route::get ( '/products', 'ProductController@index' )->name ('listado_productos'); // listado
   Route::get ( '/products/create', 'ProductController@create' )->name ( 'create' ); // formulario creación
   Route::post ( '/products', 'ProductController@store' )->name ( 'store' ); // store
   Route::get ( '/products/{id}/edit', 'ProductController@edit' )->name ( 'edit' ); // Formulario edición
   Route::post ( '/products/{id}/update', 'ProductController@update' )->name ( 'update' ); // update
   Route::delete ( '/products/{id}', 'ProductController@destroy' )->name ( 'destroy' ); // Formulario eliminación

   Route::get ( '/products/{id}/images', 'ImageController@index' ); // listado y formulario creación
   Route::post ( '/products/{id}/images', 'ImageController@store' ); // store
   Route::delete ( '/products/{id}/images', 'ImageController@destroy' ); // form eliminar
   Route::get ( '/products/{id}/images/select/{image}', 'ImageController@select' ); // destacar un imagen

   Route::get ( '/categories', 'CategoryController@index' ); // listado
   Route::get ( '/categories/create', 'CategoryController@create' )->name ( 'create' ); // formulario creación
   Route::post ( '/categories', 'CategoryController@store' )->name ( 'store' ); // store
   Route::get ( '/categories/{category}/edit', 'CategoryController@edit' )->name ( 'edit' ); // Formulario edición
   Route::post ( '/categories/{category}/update', 'CategoryController@update' )->name ( 'update' ); // update
   Route::delete ( '/categories/{category}', 'CategoryController@destroy' )->name ( 'destroy' ); // Formulario eliminación

} );

