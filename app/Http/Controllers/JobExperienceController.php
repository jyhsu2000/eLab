<?php

namespace App\Http\Controllers;

use App\JobExperience;
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
        //TODO: 檢查有無權限管理指定個人資料
        //TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: 檢查有無權限管理指定個人資料
        //TODO
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobExperience  $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(JobExperience $jobExperience)
    {
        //TODO: 檢查有無權限管理指定工作經歷
        //TODO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobExperience  $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobExperience $jobExperience)
    {
        //TODO: 檢查有無權限管理指定工作經歷
        //TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobExperience  $jobExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobExperience $jobExperience)
    {
        //TODO: 檢查有無權限管理指定工作經歷
        //TODO
    }
}
