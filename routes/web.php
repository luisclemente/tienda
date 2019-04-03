<?php

use App\Category;
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

Route::get('/set_language/{lang}', 'Controller@setLanguage')->name ('set_language');

Route::get ( '/', function () {
   $categories = Category::has ( 'products' )->get ();
   return view ( 'welcome', compact ( 'categories' ) );
} );

Auth::routes ();

Route::get ( '/search', 'SearchController@show' )->name ('search_product');
Route::get ( '/products/json', 'SearchController@data' );

Route::get ( '/home', 'HomeController@index' )->name ( 'home' );

Route::get ( '/ordered_carts', 'CartController@ordered_carts' )->name ( 'ordered_carts' );

Route::get ( '/products/{product}', 'ProductController@show' )->name ('product_show');

Route::get ( '/categories/{category}', 'CategoryController@show' )->name ('category_show');

Route::post ( '/carts', 'CartDetailController@store' )->name ('cartDetail_store');
Route::delete ( '/carts/{detail}', 'CartDetailController@destroy' )->name ('cart_destroy');

Route::post ( '/carts/{detail}', 'CartDetailController@update' )->name ('cartDetail_update');
Route::post ( '/updateWithModal', 'CartDetailController@updateWithModal' )->name ('cartDetail_updateWithModal');

Route::post ( '/order', 'CartController@update' )->name ('place_order');

Route::middleware ( [ 'auth', 'admin' ] )->prefix ( 'admin' )->namespace ( 'Admin' )->group ( function () {
   Route::get ( '/products', 'ProductController@index' )->name ('admin_products_index');
   Route::get ( '/sort/{column}', 'ProductController@sort' )->name ('admin_products_sort');
   Route::get ( '/products/create', 'ProductController@create' )->name ( 'product_create' );
   Route::post ( '/products', 'ProductController@store' )->name ( 'product_store' );
   Route::get ( '/products/{product}', 'ProductController@edit' )->name ( 'product_edit' );
   Route::post ( '/products/{product}', 'ProductController@update' )->name ( 'product_update' );
   Route::delete ( '/products/{product}', 'ProductController@destroy' )->name ( 'product_destroy' );

   Route::get ( '/products/images/{product}', 'ImageController@index' )->name ('product_images_index'); // listado y formulario creación
   Route::post ( '/products/images/{id}', 'ImageController@store' );
   Route::delete ( '/products/images/{id}', 'ImageController@destroy' );
   Route::get ( '/products/image/featured/{id}/{productImage}', 'ImageController@featured' )
      ->name ('product_image_featured'); // destacar un imagen

   Route::get ( '/categories', 'CategoryController@index' )->name ('admin_categories_index'); // listado
   Route::get ( '/categories/create', 'CategoryController@create' )->name ( 'category_create' );
   Route::post ( '/categories', 'CategoryController@store' )->name ( 'category_store' ); // store
   Route::get ( '/categories/{category}', 'CategoryController@edit' )->name ( 'category_edit' );
   Route::post ( '/categories/{category}', 'CategoryController@update' )->name ( 'category_update' );
   Route::delete ( '/categories/{category}', 'CategoryController@destroy' )->name ( 'category_destroy' );

   Route::get ( '/products/stock/{product}', 'StockController@edit' )->name ( 'stock_edit' );
   Route::post ( '/products/stock/{product}', 'StockController@update' )->name ( 'stock_update' );

} );


