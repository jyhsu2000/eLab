<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\UserProfile::class, 10)->create()->each(function ($userProfile) {
            /** @var \App\UserProfile $userProfile */
            /** @var \Illuminate\Support\Collection|\App\ContactInfo[] $contactInfos */
            $contactInfos = factory(\App\ContactInfo::class, 5)->make();
            foreach ($contactInfos as $contactInfo) {
                \App\ContactInfo::updateOrCreate([
                    'user_profile_id' => $userProfile->id,
                    'contact_type_id' => $contactInfo->contactType->id,
                ], [
                    'content'   => $contactInfo['content'],
                    'is_public' => $contactInfo['is_public'],
                ]);
            }
        });
    }
}
