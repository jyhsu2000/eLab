<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\UserProfile::class, function (Faker $faker) {
    $userWithoutProfileIds = \App\User::has('userProfile', '=', 0)->pluck('id')->toArray();
    $userId = (count($userWithoutProfileIds) > 0) ? $faker->optional()->randomElement($userWithoutProfileIds) : null;
    $inYear = $faker->numberBetween(90, \Carbon\Carbon::now()->year - 1911);
    $graduateYear = ((\Carbon\Carbon::now()->year - 1911) - $inYear > 2 && $faker->boolean(80))
        ? $inYear + $faker->numberBetween(2, 6) : null;

    return [
        'user_id'       => $userId,
        'in_year'       => $inYear,
        'graduate_year' => $graduateYear,
        'in_school'     => $faker->boolean,
        'type'          => $faker->randomElement(['教授', '碩士班', '博士班', '碩專班']),
        'name'          => $faker->name,
        'nickname'      => $faker->name,
        'email'         => $faker->email,
        'office_phone'  => $faker->optional()->phoneNumber,
        'home_phone'    => $faker->optional()->phoneNumber,
        'cell_phone'    => $faker->optional()->phoneNumber,
        'link'          => $faker->optional()->url,
        'info'          => $faker->optional()->sentence,
    ];
});
