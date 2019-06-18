<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Provider extends Model
{
   use Sortable;
   public $sortable = [ 'id', 'name' ];

   public function products ()
   {
      return $this->belongsToMany  ( Product::class )->withPivot ('price', 'discount');
   }
}
