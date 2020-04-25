<?php

#Admin Routes
Route::get('admin/login', 'AdminController@redirectToGoogle');
Route::get('admin/logout', 'AdminController@logout');
Route::get('admin/callback', 'AdminController@handleGoogleCallback');
Route::get('admin/notice', 'AdminController@notice');
Route::get('admin', 'AdminController@index');
Route::get('admin/ajax', 'AdminController@ajax');
Route::post('admin/notify', 'AdminController@notify');
#Content Routes
foreach (config('site.content') as $content => $config) {
    Route::resource('admin/'.$content, ucfirst($content).'Controller');
}
Route::resource('admin/modules', 'ModulesController');

#Frontend Routes
Route::get('/', 'FrontendController@index');
Route::post('ajax', 'FrontendController@ajax');

Route::get('logout', 'FrontendController@logout');
Route::post('register', 'FrontendController@register');
Route::post('login', 'FrontendController@login');
Route::post('forgot', 'FrontendController@forgot');
Route::get('reset/{token}', 'FrontendController@reset');


Route::post('place_order', 'FrontendController@place_order');
Route::get('lien-he', 'FrontendController@contact');
Route::get('order', 'FrontendController@order');
Route::get('tu-khoa/{value}', 'FrontendController@tag');
Route::get('video/{value?}', 'FrontendController@video');
Route::get('khuyen-mai/{value?}', 'FrontendController@coupon');
Route::post('save_contact', 'FrontendController@saveContact');
Route::get('san-pham/{value?}', 'FrontendController@product');
Route::get('{value}', 'FrontendController@main');