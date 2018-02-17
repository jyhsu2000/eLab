<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use Setting;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $setting = collect(Setting::all());

        return view('setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @return \Illuminate\Http\Response
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
        //TODO: 處理其他設定
        //儲存設定
        Setting::save();

        return redirect()->route('setting.edit')->with('success', '網站設定已更新');
    }
}
