<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $fillable = [ 'name', 'description' ];

   public function products ()
   {
      return $this->hasMany ( Product::class );
   }

   public function getFeaturedImageUrlAttribute ()
   {
      if ( $this->image )
         return '/images/categories/' . $this->image;
      $firstProduct = $this->products ()->first ();
      if($firstProduct)
         return $firstProduct->featured_image_url;
      return '/images/products/default.png';
   }
}
