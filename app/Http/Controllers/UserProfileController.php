<?php

namespace App\Http\Controllers;

use App\DataTables\UserProfileDataTable;
use App\Http\Requests\UserProfileRequest;
use App\UserProfile;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserProfileDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(UserProfileDataTable $dataTable)
    {
        return $dataTable->render('user-profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserProfileRequest $request)
    {
        $userProfile = UserProfile::create($request->all());

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
        return view('user-profile.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        return view('user-profile.edit', compact('userProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserProfileRequest $request
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileRequest $request, UserProfile $userProfile)
    {
        $userProfile->update($request->all());

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
