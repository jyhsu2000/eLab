<?php

namespace App\Http\Controllers;

use App\DataTables\MemberDataTable;
use App\UserProfile;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MemberDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(MemberDataTable $dataTable)
    {
        return $dataTable->render('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //防止檢視非成員資料
        if (!$userProfile->is_member) {
            abort('404');
        }
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

        return view('member.show', compact('userProfile', 'contactInfos', 'jobExperiences'));
    }
}
