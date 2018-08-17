<?php

use Faker\Generator as Faker;

$factory->define(App\Invoice::class, function (Faker $faker) {
    $created_at = $faker->dateTimeThisDecade();

    return [
        'invoice_no' => $faker->ean8,
        'weight'     => $faker->randomFloat(2, 1, 100),
        'cost'       => $faker->randomFloat(2, 1, 1000),
        'paper_work' => $faker->randomElement([
            'example-document-1.pdf',
            'example-document-2.pdf',
            'example-document-3.pdf',
        ]),
        'status'     => $faker->randomElement(\App\Invoice::availableStatuses()),
        'created_at' => $created_at,
        'updated_at' => $faker->dateTimeBetween($created_at, 'now'),
    ];
});
