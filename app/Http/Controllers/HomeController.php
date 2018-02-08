<?php

namespace App\Http\Controllers;

use App\UserProfile;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = UserProfile::whereInSchool(true)->get();

        return view('index', compact('members'));
    }
}
