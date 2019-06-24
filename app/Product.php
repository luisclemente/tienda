<?php

namespace App;

use App\Events\ProductPriceWasChangedEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
   use Sortable;
   public $sortable = [ 'id', 'name', 'description', 'price', 'category_id', 'stock' ];

   protected $fillable = [ 'name', 'description', 'price', 'long_description', 'category_id', 'stock' ];

   public static function boot ()
   {
      parent::boot ();
      static::created ( function ( Product $product ) {
         if ( ! \App::runningInConsole () )
         {
            if ( ! $product->Has('categories'))
            {
               $category = Category::find ( 1 );
               $category->products ()->attach ( $product->id );
            }
         }
      } );

      static::updated ( function ( Product $product ) {
         if ( ! \App::runningInConsole () )
         {
            ProductPriceWasChangedEvent::dispatch ( $product );
         }
      } );
   }

   public function categories ()
   {
      return $this->belongsToMany ( Category::class );
   }

   public function images ()
   {
      return $this->hasMany ( ProductImage::class );
   }

   public function cart_details ()
   {
      return $this->hasMany ( CartDetail::class );
   }

   public function order_items ()
   {
      return $this->hasMany ( OrderItem::class );
   }

   public function providers ()
   {
      return $this->belongsToMany ( Provider::class )->withPivot ( 'price', 'discount' );
   }

   /*
    * Accesor para solucionar el problema en la vista home de productos que no tengan imágenes asociadas.
    */
   public function getFeaturedImageUrlAttribute ()
   {
      $featuredImage = $this->images ()->where ( 'featured', true )->first ();
      if ( ! $featuredImage ) // Si el producto no tiene una imagen destacada
         $featuredImage = $this->images ()->first (); // Devolveremos la primera imagen
      if ( $featuredImage ) // Si el producto tenía imágenes (destacada o adjudicada en caso contrario)
         return $featuredImage->url;
      return '/images/products/default.png'; // Si el producto no tiene imágenes, se le asigna una por defecto
   }

   public function getCategoryNameAttribute ()
   {
      if ( $this->category )
         return $this->category->name;

      return 'General';
   }

   public function priceVariation ( $request, Product $product )
   {
      if ( $request->price > $product->price )
      {
         $product->price_changed = Carbon::now (); // Guardamos en bd la fecha en que el producto subió de precio
         $product->previous_price = $product->price;
         $product->save ();
      }

      return $product;
   }

   public function productIsAlreadyInCart ()
   {
      $productInCart = false;

      if ( auth ()->check () )
         foreach ( auth ()->user ()->cart->details as $detail )
            if ( $detail->product_id == $this->id )
               return $productInCart = true;

      return $productInCart;
   }

   public static function availableUnits ( $request, $quantity = null )
   {
      $quantity = $quantity ? : $request->quantity;
      $stockTotal = $request->product_stock - $quantity;

      if ( $stockTotal < 0 )
         $quantity = $request->product_stock;

      return $quantity;
   }
}
