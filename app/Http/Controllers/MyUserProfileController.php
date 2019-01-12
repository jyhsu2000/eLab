<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use App\ContactType;
use App\Http\Requests\UserProfileRequest;
use App\Services\UserProfileService;
use App\User;
use App\UserProfile;

class MyUserProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        /** @var User $user */
        $user = \Auth::user();
        $userProfile = $user->userProfile;
        if (!$userProfile) {
            return redirect()->route('my-user-profile.create-or-edit');
        }

        $contactInfos = $userProfile->contactInfos()->with('contactType')->get();
        $jobExperiences = $userProfile->jobExperiences;

        return view('user-profile.my.show', compact('userProfile', 'contactInfos', 'jobExperiences'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createOrEdit()
    {
        /** @var User $user */
        $user = \Auth::user();
        $userProfile = $user->userProfile;

        $contactTypes = ContactType::all();
        $contactInfos = $userProfile ? $userProfile->contactInfos->keyBy('contact_type_id') : collect();

        return view('user-profile.my.edit', compact('userProfile', 'contactTypes', 'contactInfos'));
    }

    /**
     * @param UserProfileRequest $request
     * @param UserProfileService $userProfileService
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function storeOrUpdate(UserProfileRequest $request, UserProfileService $userProfileService)
    {
        /** @var User $user */
        $user = \Auth::user();
        $request->request->remove('user_id');
        $request->merge([
            'is_member' => $request->exists('is_member'),
            'in_school' => $request->exists('in_school'),
        ]);
        /** @var UserProfile $userProfile */
        $userProfile = UserProfile::updateOrCreate(['user_id' => $user->id], $request->all());

        //新相片
        $photoFile = $request->file('photo');
        //移除舊相片
        if ($photoFile || $request->exists('delete_photo')) {
            $oldPhoto = $userProfile->attachment('photo');
            if ($oldPhoto) {
                $oldPhoto->delete();
                $userProfile->touch();
            }
        }
        //新照片
        if ($photoFile) {
            $userProfileService->attachUploadedPhoto($userProfile, $photoFile);
        }

        //聯絡資訊
        $contactTypes = ContactType::all();
        foreach ($contactTypes as $contactType) {
            $content = request()->get('contact_' . $contactType->id);
            if (empty($content)) {
                //未填寫內容，刪除對應項目
                ContactInfo::where('user_profile_id', $userProfile->id)
                    ->where('contact_type_id', $contactType->id)->delete();
                continue;
            }
            //更新聯絡資訊
            ContactInfo::updateOrCreate([
                'user_profile_id' => $userProfile->id,
                'contact_type_id' => $contactType->id,
            ], [
                'content'   => $content,
                'is_public' => request()->exists('is_public_' . $contactType->id),
            ]);
        }

        return redirect()->route('my-user-profile.index')->with('success', '資料已更新');
    }
}
