<?php

namespace App\Observers;

use App\UserProfile;

class UserProfileObserver
{
    /**
     * @param UserProfile $userProfile
     * @throws \Exception
     */
    public function deleted(UserProfile $userProfile)
    {
        //自動刪除所有附件，避免殘留紀錄與檔案
        foreach ($userProfile->attachments as $attachment) {
            $attachment->delete();
        }
    }
}
