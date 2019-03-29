<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
   use Sortable;
   public $sortable = [ 'name', 'description', 'price', 'category_id' ];

   protected $fillable = [ 'name', 'description', 'price', 'long_description', 'category_id' ];

   public static $rules = [
      'name' => 'required | min:3',
      'description' => 'required | max:200',
      'price' => 'required | numeric | min:0'
   ];
   public static $messages = [
      'name.required' => 'El nombre es obligatorio',
      'name.min' => 'El nombre ha de tener al menos 3 caracteres',
      'description.required' => 'La descripción es obligatoria',
      'description.max' => 'La descripción no puede tener más de 200 caracteres',
      'price.required' => 'El precio es obligatorio',
      'price.numeric' => 'El precio debe ser un número',
      'price.min' => 'El precio mínimo es cero'
   ];

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
      if ( $this->category )
         return $this->category->name;

      return 'General';
   }

   public function sortColumnTable ()
   {
      $name = 'name';
      $description = 'description';
      $category = 'category';
      $price = 'price';
      $asc = 'ASC';
      $desc = 'DESC';


   }
}
