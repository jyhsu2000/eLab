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
        //背景圖片網址（預設圖片）
        $backgroundUrls = [
            'title'   => 'https://i.imgur.com/GjscCgG.jpg',
            'intro'   => 'https://i.imgur.com/ZOcLM7h.jpg',
            'teacher' => 'https://i.imgur.com/2OmYzOU.jpg',
            'member'  => 'https://i.imgur.com/EhWls2N.jpg',
        ];
        $independentFileNames = array_map(function ($key) {
            return 'background_' . $key;
        }, array_keys($backgroundUrls));
        /** @var Collection|IndependentFile $independentFiles */
        $independentFiles = IndependentFile::whereIn('name', $independentFileNames)->get()->keyBy('name');

        foreach ($backgroundUrls as $key => $default) {
            /** @var IndependentFile $independentFile */
            $independentFile = $independentFiles->get('background_' . $key);
            if ($independentFile && $independentFile->file_url) {
                $backgroundUrls[$key] = $independentFile->file_url;
            }
        }

        $members = UserProfile::whereInSchool(true)->get();

        return view('index', compact('backgroundUrls', 'members'));
    }
}
