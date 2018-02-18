<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\IndependentFile;
use Illuminate\Database\Eloquent\Collection;
use Setting;

class SettingController extends Controller
{
    private static $backgroundSettingItems = [
        'title'   => '標題',
        'intro'   => '實驗室簡介',
        'teacher' => '指導教授',
        'member'  => '實驗室成員',
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
        $backgroundSettingItems = self::$backgroundSettingItems;
        //背景圖名稱
        $independentFileNames = array_map(function ($key) {
            return 'background_' . $key;
        }, array_keys($backgroundSettingItems));
        //對應獨立檔案Model
        /** @var Collection|IndependentFile $independentFiles */
        $independentFiles = IndependentFile::whereIn('name', $independentFileNames)->get()->keyBy('name');
        $backgroundUrls = [];
        foreach ($backgroundSettingItems as $key => $name) {
            /** @var IndependentFile $independentFile */
            $independentFile = $independentFiles->get('background_' . $key);
            if ($independentFile) {
                $backgroundUrls[$key] = $independentFile->file_url;
            } else {
                $backgroundUrls[$key] = null;
            }
        }

        return view('setting.edit', compact('setting', 'backgroundSettingItems', 'backgroundUrls'));
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
        //背景圖片
        $backgroundSettingItems = self::$backgroundSettingItems;
        foreach ($backgroundSettingItems as $key => $name) {
            /** @var IndependentFile $independentFile */
            $independentFile = IndependentFile::firstOrCreate(['name' => 'background_' . $key]);
            //新圖片
            $backgroundImageFile = $request->file('background_' . $key);
            //移除舊圖片
            if ($backgroundImageFile || $request->exists('delete_background_' . $key)) {
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
