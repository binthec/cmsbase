<?php

/**
 * 管理画面側
 */
Route::domain(env('BACKEND_DOMAIN'))->namespace('Backend')->group(function () {
    /**
     * 認証しなくても見られる画面
     */
    Route::middleware('guest')->group(function () {
        Route::get('/', 'Auth\LoginController@showLoginForm');

        //認証系
        Route::get('login', 'Auth\LoginController@showLoginForm');
        Route::post('login', 'Auth\LoginController@login')->name('login');
//		Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//		Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//		Route::post('password/reset', 'Backend\Auth\ForgotPasswordController@reset');
//		Route::get('password/reset/{token}', 'Backend\Auth\ForgotPasswordController@showResetForm')->name('password.reset');
    });

    /**
     * 認証の必要な画面
     */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        //ログアウト
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        //トップ画像
        Route::post('topimage/pict/store', 'TopimageController@pictStore')->name('topimage.pict.store'); //XHRでの画像アップロード
        Route::post('topimage/pict/delete', 'TopimageController@pictDelete')->name('topimage.pict.delete'); //ajaxでの画像削除
        Route::get('topimage/order', 'TopimageController@orderEdit')->name('topimage.order.edit');
        Route::post('topimage/order', 'TopimageController@orderUpdate')->name('topimage.order.update');
        Route::resource('topimage', 'TopimageController', ['except' => 'show']);

        //活動報告
        Route::post('activity/pict/store', 'ActivityController@pictStore')->name('activity.pict.store'); //XHRでの画像アップロード
        Route::post('activity/pict/delete', 'ActivityController@pictDelete')->name('activity.pict.delete'); //ajaxでの画像削除
        Route::get('activity/confirm/{activity}', 'ActivityController@confirm')->name('activity.confirm'); //表示確認
        Route::resource('activity', 'ActivityController');

        //カレンダー
        Route::resource('event', 'EventController', ['except' => ['create', 'edit', 'show']]);

        //ユーザ管理
        Route::get('mypage', 'UserController@myPage')->name('mypage');
        Route::put('user/{user}', 'UserController@update')->name('user.update');
        Route::put('user/password/{user}', 'UserController@updatePassword')->name('user.password.update');

        /**
         * オーナー以上（＝システム管理者とオーナー）にのみ許可された操作
         */
        Route::group(['middleware' => 'can:owner-higher'], function () {
            //ユーザ管理
            Route::get('user/create', 'Auth\RegisterController@showRegistrationForm')->name('user.create');
            Route::post('user', 'Auth\RegisterController@register')->name('user.store');
            Route::get('user/password/{user}/edit', 'UserController@editPassword')->name('user.password.edit');
            Route::resource('user', 'UserController', ['except' => ['create', 'store', 'update']]);

            //アクションログ
            Route::resource('actionlog', 'Backend\ActionLogController');
        });
    });
});


/**
 * フロント側
 */
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    //活動の様子
    Route::get('/activity', 'ActivityController@index')->name('front.act.index');
    Route::get('/activity/{activity}', 'ActivityController@detail')->name('front.act.detail');
});
