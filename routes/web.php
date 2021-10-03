<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'HomeController@index')->name("home.index");

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


//MESSAGES
Route::post('/messages/store', 'MessageController@store')->name("messages.store");
Route::delete('/messages/{message}', 'MessageController@destroy')->name("messages.destroy");
Route::post('/messages/{message}', 'MessageController@update')->name("messages.update");
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'MessageController@index')->name('dashboard');


// VIDEOS
// Route::group( ['middleware' => ['auth:sanctum'] ] ,function () {
	Route::get('/videos/list', 'VideoController@list')->name("videos.list");
	Route::get('/videos/{video}/download', 'VideoController@download')->name("videos.download");
	Route::post('/videos/encoding_progress', 'VideoController@get_session_encoding_progress')->name("videos.encoding_progress");

	Route::get('/videos/create_view/{id}', 'VideoController@create_view')->name("videos.create_view");


	Route::resource('videos', VideoController::class);
// });


// USERS
Route::middleware(['auth:sanctum'])->get('/users', 'UserController@index')->name("users.index");
Route::middleware(['auth:sanctum'])->post('/users/update/{user}', 'UserController@update')->name("users.update");


// PHOTOS
Route::delete('/photos/{photo}/destroy_photo', 'GalleryController@destroy_photo')->name("photos.destroy_photo");
Route::get('/photos/list', 'GalleryController@list')->name("photos.list");
Route::get('/photos/{photo}/download', 'GalleryController@download')->name("photos.download");
Route::resource('photos', GalleryController::class);

Route::resource('categories', CategoryController::class);


// LIVES

// Route::middleware(['auth:sanctum'])->resource('lives', LiveController::class);
Route::group( ['middleware' => ['auth:sanctum'] ] ,function () {
	Route::get('/lives', 'LiveController@index')->name("lives.index");
	Route::get('/lives/create', 'LiveController@create')->name("lives.create");
	Route::get('/lives/{live}','LiveController@show')->name("lives.show");
	Route::post('/lives', 'LiveController@store')->name("lives.store");
	Route::get('/lives/{live}/edit', 'LiveController@edit')->name("lives.edit");
	Route::patch('lives/{live}','LiveController@update')->name("lives.update");
	Route::delete('lives/{live}','LiveController@destroy')->name("lives.destroy");

	Route::post('/lives/update/{live}', 'LiveController@update_featured')->name("lives.update_featured");

});



Route::get('/history', 'HistoryController@index')->name("history.index");
// Route::resource('histories', HistoryController::class);




// ARTICLES
Route::middleware(['auth:sanctum'])->resource('articles', ArticleController::class);
Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');



Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});




// PLANNER
Route::group( ['middleware' => ['auth:sanctum'] ] ,function () {
    Route::get('/planner', 'PlannerController@index')->name("plans.index");
    Route::get('/planner/create', 'PlannerController@create')->name("plans.create");
    Route::post('/planner', 'PlannerController@store')->name("plans.store");
    Route::get('/planner/{plan}/edit', 'PlannerController@edit')->name("plans.edit");
    Route::get('/planner/{plan}', 'PlannerController@show')->name("plans.show");
    Route::patch('planner/{plan}','PlannerController@update')->name("plans.update");
    Route::delete('planner/{plan}','PlannerController@destroy')->name("plans.destroy");
    Route::get('/planner/favorite/{plan}', 'PlannerController@addToFavorites')->name("plans.favorite");
});


// Route::get('/telegram/connect', 'TelegramController@connect')->name('telegram.connect');
// Route::get('/telegram/callback', 'TelegramController@callback')->name('telegram.callback');




