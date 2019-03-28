<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public function category ()
   {
      return $this->belongsTo ( Category::class );
   }

   public function images ()
   {
      return $this->hasMany ( ProductImage::class );
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
      if($this->category )
       return $this->category->name;

      return 'General';
   }
}
