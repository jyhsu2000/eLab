<?php

namespace App\Http\Controllers;

use App\DataTables\UserProfileDataTable;
use App\Http\Requests\UserProfileRequest;
use App\User;
use App\UserProfile;
use Illuminate\Http\UploadedFile;

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
        return view('user-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserProfileRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(UserProfileRequest $request)
    {
        $userProfile = UserProfile::create($request->all());
        //清除其他屬於該User的UserProfile的user_id，確保一對一
        $userId = $request->get('user_id');
        if ($userId) {
            UserProfile::where('id', '<>', $userProfile->id)->whereUserId($userId)->update(['user_id' => null]);
        }

        //新相片
        $photoFile = $request->file('photo');
        if ($photoFile) {
            $this->attachUploadedPhoto($userProfile, $photoFile);
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
        if (!\Laratrust::owns($userProfile) && !\Laratrust::can('user-profile.manage')) {
            return redirect()->route('user-profile.show', $userProfile)->with('warning', '無法編輯他人資料');
        }

        return view('user-profile.edit', compact('userProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserProfileRequest $request
     * @param  \App\UserProfile $userProfile
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(UserProfileRequest $request, UserProfile $userProfile)
    {
        if (!\Laratrust::can('user-profile.manage')) {
            //無管理權限者，禁止修改成員對應使用者
            $request->merge(['user_id' => $userProfile->user_id]);
        }
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
            $this->attachUploadedPhoto($userProfile, $photoFile);
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

    /**
     * @param UserProfile $userProfile
     * @param UploadedFile $uploadedFile
     * @throws \Exception
     */
    private function attachUploadedPhoto(UserProfile $userProfile, UploadedFile $uploadedFile)
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
