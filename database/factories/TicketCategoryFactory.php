<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TicketCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
