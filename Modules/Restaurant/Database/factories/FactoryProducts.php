<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\Restaurant\Entities\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description_small' => $faker->text($maxNbChars = 200),
        'price_sale' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'stock' => $faker->randomDigit,
        'vistas' => $faker->randomDigit,
        
    ];
});
