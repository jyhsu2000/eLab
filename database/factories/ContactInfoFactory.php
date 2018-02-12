<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\ContactInfo::class, function (Faker $faker) {
    $userProfileIds = \App\UserProfile::pluck('id')->toArray();
    $contactTypes = \App\ContactType::all()->toArray();
    $contactType = $faker->randomElement($contactTypes);
    if ($contactType['name'] == '聯絡信箱') {
        $content = $faker->email;
    } elseif ($contactType['name'] == '個人網址') {
        $content = $faker->url;
    } else {
        $content = $faker->phoneNumber;
    }

    return [
        'user_profile_id' => $faker->randomElement($userProfileIds),
        'contact_type_id' => $contactType['id'],
        'content'         => $content,
        'is_public'       => $faker->boolean,
    ];
});
