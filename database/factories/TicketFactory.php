<?php

use Faker\Generator as Faker;
$factory->define(App\Models\Ticket::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->email,
        'phone_num' => $faker->tollFreePhoneNumber,
        'description' => $faker->text,
        'hash' => str_random()
    ];
});
