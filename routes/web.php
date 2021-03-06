<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首頁
Route::get('/', 'HomeController@index')->name('index');

//成員清單
Route::resource('member', 'MemberController', [
    'only' => [
        'index',
        'show',
    ],
]);
Route::resource('job-experience', 'JobExperienceController', [
    'except' => [
        'index',
        'show',
    ],
]);

//研究計畫
Route::resource('research-project', 'ResearchProjectController')->except([
    'show',
]);
//學術活動 - 擔任國內外學術期刊編輯委員
Route::resource('academic-event-journal-editor', 'AcademicEventJournalEditorController')->except([
    'show',
]);
//學術活動 - 擔任國內外學術研討會議程委員
Route::resource('academic-event-agenda-member', 'AcademicEventAgendaMemberController')->except([
    'show',
]);
//學術活動 - 擔任國內外學術研討會議程主持人
Route::resource('academic-event-seminar-host', 'AcademicEventSeminarHostController')->except([
    'show',
]);
//學術活動 - 擔任國際學術期刊之論文評審委員
Route::resource('academic-event-paper-committee', 'AcademicEventPaperCommitteeController')->except([
    'show',
]);
//學術活動 - 應聘擔任國內重要委員會委員
Route::resource('academic-event-committee-member', 'AcademicEventCommitteeMemberController')->except([
    'show',
]);
//學術活動 - 學術演講
Route::resource('academic-speech', 'AcademicSpeechController')->except([
    'show',
]);
//學術活動 - 學術榮譽
Route::resource('academic-honor', 'AcademicHonorController')->except([
    'show',
]);

//會員（須完成信箱驗證）
Route::group(['middleware' => ['auth', 'email']], function () {
    //會員管理
    //權限：user.manage、user.view
    Route::resource('user', 'UserController', [
        'except' => [
            'create',
            'store',
        ],
    ]);
    //角色管理
    //權限：role.manage
    Route::group(['middleware' => 'permission:role.manage'], function () {
        Route::resource('role', 'RoleController', [
            'except' => [
                'show',
            ],
        ]);
    });
    //會員資料
    Route::group(['prefix' => 'profile'], function () {
        //查看會員資料
        Route::get('/', 'ProfileController@getProfile')->name('profile');
        //編輯會員資料
        Route::get('edit', 'ProfileController@getEditProfile')->name('profile.edit');
        Route::put('update', 'ProfileController@updateProfile')->name('profile.update');
    });
    //網站設定
    Route::group(['middleware' => 'permission:setting.manage'], function () {
        Route::get('setting', 'SettingController@edit')->name('setting.edit');
        Route::patch('setting', 'SettingController@update')->name('setting.update');
    });
    //成員管理
    Route::group(['middleware' => 'permission:user-profile.manage'], function () {
        Route::resource('user-profile', 'UserProfileController');
    });
    //成員資料
    Route::group(['prefix' => 'my-user-profile'], function () {
        Route::get('/', 'MyUserProfileController@index')->name('my-user-profile.index');
        Route::get('edit', 'MyUserProfileController@createOrEdit')->name('my-user-profile.create-or-edit');
        Route::patch('update', 'MyUserProfileController@storeOrUpdate')->name('my-user-profile.store-or-update');
    });
    //權限：限實驗室成員進入
    Route::group(['middleware' => 'lab-member'], function () {
        //
    });
});

//會員系統
//將 Auth::routes() 複製出來自己命名
Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('logout', 'LoginController@logout')->name('logout');
    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register');
    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
    //修改密碼
    Route::get('password/change', 'PasswordController@getChangePassword')->name('password.change');
    Route::put('password/change', 'PasswordController@putChangePassword')->name('password.change');
    //驗證信箱
    Route::get('resend', 'RegisterController@resendConfirmMailPage')->name('confirm-mail.resend');
    Route::post('resend', 'RegisterController@resendConfirmMail')->name('confirm-mail.resend');
    Route::get('confirm/{confirmCode}', 'RegisterController@emailConfirm')->name('confirm');
});
