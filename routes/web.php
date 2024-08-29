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

// 會自動把 crud 都建立完成，對應到 PostController裡的七個方法
// Route::resource('posts', 'PostController')
// 對應到 PostController裡的指定方法
// Route::resource('posts', 'PostController')->only(['index', 'show']);
// 對應到除了 PostController裡的指定方法
// Route::resource('posts', 'PostController')->except(['create', 'store']);

// Route::resource('posts', 'PostController')->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::get('/posts', 'PostController@show');

// 這個寫法比較不簡潔，function 直接寫在這會比較長
Route::get('/', function () {
    // resources/views 底下會有個 index.blade.php 檔
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/admin', 'PostController@admin');
    Route::get('/posts/create', 'PostController@create');
    // {post} 雖是帶 id，實際 laravel會自動轉換成 Post model，store、show、update、destroy 是照 laravel 的命名慣例
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/show/{post}', 'PostController@show');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@destroy');
    // 建立除了 show 以外的 route https://laravel.tw/docs/5.2/controllers
    Route::resource('categories', 'CategoryController')->except(['show']);
});

Route::get('/posts', 'PostController@index');
Route::get('/posts/{post}', 'PostController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
