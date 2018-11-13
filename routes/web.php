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
    if(Auth::check()){
        if (Auth::user()->type == 'admin') {
            return redirect('/admins/dashboard');
        } else if (Auth::user()->type == 'teachers') {
            return redirect('/teachers/school');
        } else {
            return redirect('/students/classroom');
        }
    } else {
        return view('auth/login');
    }
});

Route::group(['middleware' => ['auth']], function (){

    Route::prefix('admins')->namespace('Admin')->group(function (){

        Route::prefix('dashboard')->group(function (){
            Route::get('/', 'AdminController@index')->name('admin.index');
            Route::post('store', 'UserController@store')->name('user.store');
            Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
            Route::post('update/{id}', 'UserController@update')->name('user.update');
            Route::get('remove/{id}', 'UserController@delete')->name('user.remove');
        });
    });

    Route::prefix('teachers')->namespace('Admin')->group(function (){

        Route::prefix('school')->group(function (){
            Route::get('/', 'TeacherController@index')->name('teacher.index');
            Route::get('new', 'OerController@new')->name('oer.new');
            Route::post('store', 'UserController@store')->name('user.store');
            Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
            Route::post('update/{id}', 'UserController@update')->name('user.update');
            Route::get('remove/{id}', 'UserController@delete')->name('user.remove');

        });
        Route::prefix('oers')->group(function (){
            Route::get('/', 'OerController@index')->name('oer.index');
            Route::get('new', 'OerController@new')->name('oer.new');
            Route::post('store', 'OerController@store')->name('oer.store');
            Route::get('edit/{oer}', 'OerController@edit')->name('oer.edit');
            Route::post('update/{id}', 'OerController@update')->name('oer.update');
            Route::get('remove/{id}', 'OerController@delete')->name('oer.remove');
            Route::get('view/{uri}', 'OerController@view')->name('oer.view');
        });
    });

    Route::prefix('students')->namespace('Admin')->group(function (){

        Route::prefix('classroom')->group(function (){
            Route::get('/', 'StudentController@index')->name('student.index');
            Route::get('courses', 'UserController@new')->name('user.new');
            Route::post('store', 'UserController@store')->name('user.store');
            Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
            Route::post('update/{id}', 'UserController@update')->name('user.update');
            Route::get('remove/{id}', 'UserController@delete')->name('user.remove');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
