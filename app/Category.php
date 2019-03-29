<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $fillable = [ 'name', 'description' ];

   protected $images_directory = '/images/categories';

   public static $rules = [
      'name' => 'required|min:3',
      'description' => 'max:200'
   ];
   public static $messages = [
      'name.required' => 'El nombre es obligatorio',
      'name.min' => 'El nombre ha de tener al menos 3 caracteres',
      'description.max' => 'La descripción no puede tener más de 200 caracteres'
   ];

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
