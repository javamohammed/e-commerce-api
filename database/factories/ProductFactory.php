<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word,
        'detail' => $faker->paragraph,
        'price' => $faker->numberBetween(40, 200),
        'stock' => $faker->numberBetween(20, 100),
        'discount' => $faker->numberBetween(10, 30),
    ];
});
