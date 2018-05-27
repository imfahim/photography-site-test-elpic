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

Route::get('/', function () {

    return view('index');
});

Route::get('/','UserController@index');

Route::get('/verify/{token}', 'UserController@verifyUser');
Route::get('/invite-verify/{token}', 'InviteController@verifyInvite');

Route::group(['prefix' => 'api/v1'], function() {
 Route::post('/register', 'UserController@register')->name('user.register');
 Route::post('/login', 'UserController@login')->name('user.login');
});

Route::get('show-image/{id}/{file_name}','ImageController@show_image')->name('image.show_image');
Route::get('image/{id}/{file_name}','ImageController@priv_image')->name('image.priv_image');



Route::middleware(['login'])->group(function () {
  Route::get('/app', function () {
      return view('home');
  });
  Route::post('/download','ImageController@download')->name('image.download');
  Route::get('/logout','UserController@logout')->name('user.logout');
  Route::group(['prefix'=>'api/v2'],function(){
    Route::get('/getuser','UserController@getUser')->name('user.getuser');
    Route::post('/upload','ImageController@upload')->name('image.upload');
    Route::get('/getall','ImageController@getImages')->name('image.getall');
    Route::post('/invite','InviteController@send_invite')->name('invite.send');

  });
});
