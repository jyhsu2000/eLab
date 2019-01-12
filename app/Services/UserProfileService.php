<?php

namespace App\Services;

use App\UserProfile;
use Illuminate\Http\UploadedFile;

class UserProfileService
{
    /**
     * @param UserProfile $userProfile
     * @param UploadedFile $uploadedFile
     * @throws \Exception
     */
    public function attachUploadedPhoto(UserProfile $userProfile, UploadedFile $uploadedFile)
    {
        //建立Image
        $image = \Image::make($uploadedFile->getRealPath());
        //暫存路徑
        $tmpPath = sys_get_temp_dir() . '/' . $uploadedFile->getClientOriginalName();
        //調整圖片大小
        $image->resize(600, 600, function ($constraint) {
            /** @var \Intervention\Image\Constraint $constraint */
            //照比例
            $constraint->aspectRatio();
            //防止放大
            $constraint->upsize();
        })->save($tmpPath);
        //附加新相片
        $userProfile->attach($tmpPath, [
            'key' => 'photo',
        ]);
        //更新updated_at，避免photo吃到緩存
        $userProfile->touch();
    }
}
