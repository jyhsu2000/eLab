<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use App\ContactType;
use App\DataTables\UserProfileDataTable;
use App\Http\Requests\UserProfileRequest;
use App\Services\UserProfileService;
use App\User;
use App\UserProfile;

class UserProfileController extends Controller
{
    /**
     * UserProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:user-profile.manage', ['only' => [
            'create',
            'store',
            'destroy',
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param UserProfileDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(UserProfileDataTable $dataTable)
    {
        /** @var User $user */
        $user = auth()->user();

        return $dataTable->render('user-profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contactTypes = ContactType::all();
        $contactInfos = collect();

        return view('user-profile.create', compact('contactTypes', 'contactInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserProfileRequest $request
     * @param UserProfileService $userProfileService
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(UserProfileRequest $request, UserProfileService $userProfileService)
    {
        $request->merge([
            'is_member' => $request->exists('is_member'),
            'in_school' => $request->exists('in_school'),
        ]);
        $userProfile = UserProfile::create($request->all());
        //清除其他屬於該User的UserProfile的user_id，確保一對一
        $userId = $request->get('user_id');
        if ($userId) {
            UserProfile::where('id', '<>', $userProfile->id)->whereUserId($userId)->update(['user_id' => null]);
        }

        //新相片
        $photoFile = $request->file('photo');
        if ($photoFile) {
            $userProfileService->attachUploadedPhoto($userProfile, $photoFile);
        }

        //聯絡資訊
        $contactTypes = ContactType::all();
        foreach ($contactTypes as $contactType) {
            $content = request()->get('contact_' . $contactType->id);
            if (empty($content)) {
                //未填寫內容，直接跳過
                continue;
            }
            //建立聯絡資訊
            ContactInfo::updateOrCreate([
                'user_profile_id' => $userProfile->id,
                'contact_type_id' => $contactType->id,
            ], [
                'content'   => $content,
                'is_public' => request()->exists('is_public_' . $contactType->id),
            ]);
        }

        return redirect()->route('user-profile.show', $userProfile)->with('success', '成員已建立');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        $contactInfoQuery = $userProfile->contactInfos();
        $user = auth()->user();
        if (!\Laratrust::can('user-profile.manage') && !optional($user)->userProfile) {
            $contactInfoQuery->where('is_public', true);
        }
        $contactInfos = $contactInfoQuery->with('contactType')->get();

        $jobExperiences = $userProfile->jobExperiences;
        if (!\Laratrust::can('user-profile.manage') && !optional($user)->userProfile) {
            $jobExperiences = $userProfile->jobExperiences()->where('is_public', true)->get();
        }

        return view('user-profile.show', compact('userProfile', 'contactInfos', 'jobExperiences'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        if (!\Laratrust::owns($userProfile) && !\Laratrust::can('user-profile.manage')) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        $contactTypes = ContactType::all();
        $contactInfos = $userProfile->contactInfos->keyBy('contact_type_id');

        return view('user-profile.edit', compact('userProfile', 'contactTypes', 'contactInfos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserProfileRequest $request
     * @param  \App\UserProfile $userProfile
     * @param UserProfileService $userProfileService
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(
        UserProfileRequest $request,
        UserProfile $userProfile,
        UserProfileService $userProfileService
    ) {
        if (!\Laratrust::can('user-profile.manage')) {
            //無管理權限者，禁止修改成員對應使用者
            $request->merge(['user_id' => $userProfile->user_id]);
        }
        $request->merge([
            'is_member' => $request->exists('is_member'),
            'in_school' => $request->exists('in_school'),
        ]);
        $userProfile->update($request->all());
        //清除其他屬於該User的UserProfile的user_id，確保一對一
        $userId = $request->get('user_id');
        if ($userId) {
            UserProfile::where('id', '<>', $userProfile->id)->whereUserId($userId)->update(['user_id' => null]);
        }
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

        return redirect()->route('user-profile.show', $userProfile)->with('success', '成員已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();

        return redirect()->route('user-profile.index')->with('success', '成員已刪除');
    }
}
