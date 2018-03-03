<?php

namespace App\Http\Controllers;

use App\JobExperience;
use App\UserProfile;
use Illuminate\Http\Request;

class JobExperienceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userProfile = UserProfile::find(request('user-profile'));
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }

        //TODO
        return view('job-experience.create', compact('userProfile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userProfile = UserProfile::find(request('user_profile_id'));
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //TODO
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobExperience $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(JobExperience $jobExperience)
    {
        $userProfile = $jobExperience->userProfile;
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //TODO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\JobExperience $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobExperience $jobExperience)
    {
        $userProfile = $jobExperience->userProfile;
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobExperience $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobExperience $jobExperience)
    {
        $userProfile = $jobExperience->userProfile;
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //TODO
    }
}
