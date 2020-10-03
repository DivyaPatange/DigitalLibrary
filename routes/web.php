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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin, user')->group(function(){
    Route::resource('/users', 'UserController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/books', 'BooksController');
    Route::resource('/journals', 'JournalController');
    Route::resource('/videos', 'VideosController');
    Route::get('/journal-list', 'LibraryJournalController@journalList');
    Route::post('/uploadFile', 'LibraryJournalController@uploadCsvFile')->name('upload.csv.file');
    Route::get('/edit-journal/{id}', 'LibraryJournalController@editJournal');
});
Route::get('/user/books', 'Admin\BooksController@viewBook')->name('user.books.index');
Route::get('/book/{id}', 'Admin\BooksController@showBook')->name('book.view');
Route::get('/user/journals', 'Admin\JournalController@viewJournal')->name('user.journals.index');
Route::get('/journal/{id}', 'Admin\JournalController@showJournal')->name('journal.view');
Route::get('/user/videos', 'Admin\VideosController@viewVideo')->name('user.videos.index');
Route::get('/search', 'Admin\SearchController@search')->name('search');