<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobExperienceRequest;
use App\JobExperience;
use App\UserProfile;
use Carbon\Carbon;

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
        $options = $this->getDateSelectOptions();

        return view('job-experience.create', compact('userProfile', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JobExperienceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobExperienceRequest $request)
    {
        $userProfile = UserProfile::find(request('user_profile_id'));
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //輸入
        $data = $this->handleRequest($request);
        $data['user_profile_id'] = $userProfile->id;
        //建立
        JobExperience::create($data);

        return redirect()->route('user-profile.show', $userProfile)->with('success', '工作經歷已建立');
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
        $options = $this->getDateSelectOptions();

        return view('job-experience.edit', compact('userProfile', 'jobExperience', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobExperienceRequest $request
     * @param  \App\JobExperience $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function update(JobExperienceRequest $request, JobExperience $jobExperience)
    {
        $userProfile = $jobExperience->userProfile;
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //輸入
        $data = $this->handleRequest($request);
        $data['user_profile_id'] = $userProfile->id;
        //更新
        $jobExperience->update($data);

        return redirect()->route('user-profile.show', $userProfile)->with('success', '工作經歷已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobExperience $jobExperience
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(JobExperience $jobExperience)
    {
        $userProfile = $jobExperience->userProfile;
        //檢查有無權限管理指定個人資料
        if (!$userProfile->has_permission) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }
        //刪除
        $jobExperience->delete();

        return redirect()->route('user-profile.show', $userProfile)->with('success', '工作經歷已刪除');
    }

    private function getDateSelectOptions()
    {
        $options = [];
        $years = range(Carbon::now()->year, 1900);
        $options['year'] = [null => '年'] + array_combine($years, $years);
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = $i . ' 月';
        }
        $options['month'] = [null => '月'] + $months;
        $days = range(1, 31);
        $options['day'] = [null => '日'] + array_combine($days, $days);

        return $options;
    }

    private function handleRequest(JobExperienceRequest $request)
    {
        $data = [];
        $data['content'] = $request->get('content');
        $data['is_public'] = $request->exists('is_public');
        $data['start_year'] = $request->get('start_year') ?: null;
        $data['start_month'] = $data['start_year'] ? ($request->get('start_month') ?: null) : null;
        $data['start_day'] = ($data['start_year'] && $data['start_month'])
            ? ($request->get('start_day') ?: null) : null;
        $data['end_year'] = $request->get('end_year') ?: null;
        $data['end_month'] = $data['end_year'] ? ($request->get('end_month') ?: null) : null;
        $data['end_day'] = ($data['end_year'] && $data['end_month']) ? ($request->get('end_day') ?: null) : null;

        return $data;
    }
}
