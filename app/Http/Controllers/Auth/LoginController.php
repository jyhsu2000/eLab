<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        //若主動點擊登入，而非被middleware要求登入，記錄來源頁面作為登入後跳轉頁面
        if (!session()->has('url.intended')) {
            session(['url.intended' => \URL::previous()]);
        }

        return view('auth.login');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //若無成員資料
        if (!$user->userProfile) {
            //強制跳轉至成員資料頁面
            return redirect()->route('my-user-profile.index');
        }
    }
}
