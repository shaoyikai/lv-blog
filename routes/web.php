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
Auth::routes();

Route::get('/', function () {
    //return view('welcome');
    return redirect(route('blog_index'));
});
Route::get('/home', 'HomeController@index')->name('home');

// [blog get]
Route::get('/blog', 'BlogController@index')->name('blog_index');
Route::get('/blog/error', function () {
    return view('blog.error');
})->name('blog_error');

Route::get('/blog/archives', 'BlogController@archives')->name('blog_archives');
Route::get('/blog/view', 'BlogController@view')->name('blog_view');
Route::get('/blog/comment', 'BlogController@comment')->name('blog_comment');
Route::get('/blog/about', 'BlogController@about')->name('blog_about');
Route::get('/blog/create', 'BlogController@create')->name('blog_create');
Route::get('/blog/edit', 'BlogController@edit')->name('blog_edit');
Route::get('/blog/delete', 'BlogController@delete')->name('blog_delete');
Route::get('/blog/archives', 'BlogController@archives')->name('blog_archives');
Route::get('/blog/tags', 'BlogController@tags')->name('blog_tags');
// [blog 404]
Route::get('/blog/{other}', function ($other) {
    if (view()->exists($other)) {
        return view($other);
    }
    return redirect(route('blog_error',['message' => '页面找不到']));
});

// [blog post]
Route::post('/blog/store', 'BlogController@store')->name('blog_store');
Route::post('/blog/edit-store', 'BlogController@editStore')->name('blog_edit_store');

// [app 404]
Route::get('/{other}', function ($other) {
    if (view()->exists($other)) {
        return view($other);
    }
    return redirect(route('home'));
});
