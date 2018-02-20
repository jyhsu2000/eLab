<?php

namespace App\Http\Controllers;

use App\IndependentFile;
use App\UserProfile;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //圖片網址（預設圖片）
        $imageUrls = [
            'background_title'   => 'https://i.imgur.com/GjscCgG.jpg',
            'background_intro'   => 'https://i.imgur.com/ZOcLM7h.jpg',
            'background_teacher' => 'https://i.imgur.com/2OmYzOU.jpg',
            'background_member'  => 'https://i.imgur.com/EhWls2N.jpg',
            'teacher_photo'      => 'https://i.imgur.com/ijlqQ2a.png',
        ];
        /** @var Collection|IndependentFile $independentFiles */
        $independentFiles = IndependentFile::whereIn('name', array_keys($imageUrls))->get()->keyBy('name');

        foreach ($imageUrls as $key => $default) {
            /** @var IndependentFile $independentFile */
            $independentFile = $independentFiles->get($key);
            if ($independentFile && $independentFile->file_url) {
                $imageUrls[$key] = $independentFile->file_url;
            }
        }

        $labIntro = \Setting::get('lab_intro');
        $teacher = \Setting::get('teacher');

        $members = UserProfile::whereInSchool(true)->get();

        return view('index', compact('imageUrls', 'labIntro', 'teacher', 'members'));
    }
}
