<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\IndependentFile;
use Illuminate\Database\Eloquent\Collection;
use Setting;

class SettingController extends Controller
{
    private static $independentFileNames = [
        'background_title',
        'background_intro',
        'background_teacher',
        'background_member',
        'teacher_photo',
    ];

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $setting = collect(Setting::all());
        //背景圖項目
        $backgroundSettingItems = [
            'title'   => '標題',
            'intro'   => '實驗室簡介',
            'teacher' => '指導教授',
            'member'  => '實驗室成員',
        ];
        //對應獨立檔案Model
        /** @var Collection|IndependentFile $independentFiles */
        $independentFiles = IndependentFile::whereIn('name', static::$independentFileNames)->get()->keyBy('name');

        return view('setting.edit', compact('setting', 'backgroundSettingItems', 'independentFiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(SettingRequest $request)
    {
        //設定項目
        $settingItems = [
            'lab_name',
            'lab_full_name',
            'lab_intro',
            'teacher',
        ];
        //更新設定
        foreach ($settingItems as $settingItem) {
            $value = $request->get($settingItem);
            if (!empty($value)) {
                Setting::set($settingItem, $value);
            } else {
                Setting::forget($settingItem);
            }
        }
        foreach (static::$independentFileNames as $key) {
            /** @var IndependentFile $independentFile */
            $independentFile = IndependentFile::firstOrCreate(['name' => $key]);
            //新圖片
            $backgroundImageFile = $request->file($key);
            //移除舊圖片
            if ($backgroundImageFile || $request->exists('delete_' . $key)) {
                $oldFile = $independentFile->attachment('file');
                if ($oldFile) {
                    $oldFile->delete();
                    $independentFile->touch();
                }
            }
            //新圖片
            if ($backgroundImageFile) {
                //TODO: 圖片預處理
                //附加檔案
                $independentFile->attach($backgroundImageFile, [
                    'key' => 'file',
                ]);
                $independentFile->touch();
            }
        }

        //TODO: 處理其他設定
        //儲存設定
        Setting::save();

        return redirect()->route('setting.edit')->with('success', '網站設定已更新');
    }
}
