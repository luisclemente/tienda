<?php

use App\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
         'name' => $faker->name
    ];
});
