<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Review;
use Faker\Generator as Faker;
use App\Model\Product;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'product_id' => function(){
            return Product::all()->random();
        },
        'customer' => $faker->name,
        'review' => $faker->words($nb = 3, $asText = true),
        'star' => $faker->numberBetween(0,5),
    ];
});
