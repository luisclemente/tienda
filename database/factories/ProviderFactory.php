<?php

use App\Provider;
use Faker\Generator as Faker;

/* @var $factory \Illuminate\Database\Eloquent\Factory */

$factory->define ( Provider::class, function ( Faker $faker ) {
   return [
      'name' => $faker->name,
   ];
} );
