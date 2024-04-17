<?php

use App\Models\Category;
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
Route::group(['middleware' => ['auth:sanctum', 'isActiveUser']], function () {

    Route::get('/test', function(){
        $data['categories'] = Category::with(['latestVideos' => function ($query) {
            return $query->take(4);
        }])->get();

        foreach ($data['categories'] as $category){
            $data['category_videos'][$category->id] = $category->latestVideos;

    //                Video::with(['history','categories','categories.category','user','views'])
    //                    ->whereHas('categories', function($q) use ($category){
    //                        $q->where('category_id',  $category->id);
    //                    })
    ////                ->whereIn('file_name', $list_of_files)
    //                    ->orderBy('id','desc')->limit(4)->get();
        }

      dd($data);
    });
});



Route::get('/', 'HomeController@index')->name("home.index");

Route::group(['middleware' => ['blockedUser', 'saveIp']], function () {
    Route::post('/contact', 'HomeController@contactUs')->name("contact");

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//MESSAGES
    Route::post('/messages/store', 'MessageController@store')->name("messages.store");
    Route::delete('/messages/{message}', 'MessageController@destroy')->name("messages.destroy");
    Route::post('/messages/{message}', 'MessageController@update')->name("messages.update");
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'MessageController@index')->name('dashboard');


// VIDEOS
    Route::group(['middleware' => ['auth:sanctum', 'isActiveUser']], function () {

        Route::get('/sendTestEmail', 'TestController@sendTestEmail');//TESTING
        Route::get('/getFtpContents', 'TestController@getFtpContents');//TESTING

        Route::get('/videos/list', 'VideoController@list')->name("videos.list");
        Route::get('/videos/{video}/download', 'VideoController@download')->name("videos.download");
        Route::post('/videos/encoding_progress', 'VideoController@get_session_encoding_progress')->name("videos.encoding_progress");
    });

    Route::get('/videos/create_view/{id}', 'VideoController@create_view')->name("videos.create_view");

    Route::group(['middleware' => ['auth:sanctum', 'isActiveUser']], function () {
        Route::resource('videos', VideoController::class);
    });


// PHOTOS
    Route::delete('/photos/{photo}/destroy_photo', 'GalleryController@destroy_photo')->name("photos.destroy_photo");
    Route::get('/photos/list', 'GalleryController@list')->name("photos.list");
    Route::get('/photos/{photo}/download', 'GalleryController@download')->name("photos.download");
    Route::resource('photos', GalleryController::class);
//Route::get('/gallery/compress_uploaded', 'GalleryController@compress_uploaded')->name("compress.uploaded");





// LIVES

// Route::middleware(['auth:sanctum'])->resource('lives', LiveController::class);
    Route::group(['middleware' => ['auth:sanctum', 'isActiveUser']], function () {
        Route::get('/lives', 'LiveController@index')->name("lives.index");
        Route::get('/lives/create', 'LiveController@create')->name("lives.create");
        Route::get('/lives/{live}', 'LiveController@show')->name("lives.show");
        Route::post('/lives', 'LiveController@store')->name("lives.store");
        Route::get('/lives/{live}/edit', 'LiveController@edit')->name("lives.edit");
        Route::patch('lives/{live}', 'LiveController@update')->name("lives.update");
        Route::delete('lives/{live}', 'LiveController@destroy')->name("lives.destroy");

        Route::post('/lives/update/{live}', 'LiveController@update_featured')->name("lives.update_featured");

    });

// Route::resource('histories', HistoryController::class);

// ARTICLES
    Route::middleware(['auth:sanctum', 'isActiveUser'])->resource('articles', ArticleController::class);
    Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');

// PLANNER
    Route::group(['middleware' => ['auth:sanctum', 'isActiveUser']], function () {
        Route::get('/planner', 'PlannerController@index')->name("plans.index");
        Route::get('/planner/create', 'PlannerController@create')->name("plans.create");
        Route::post('/planner', 'PlannerController@store')->name("plans.store");
        Route::get('/planner/{plan}/edit', 'PlannerController@edit')->name("plans.edit");
        Route::get('/planner/{plan}', 'PlannerController@show')->name("plans.show");
        Route::patch('planner/{plan}', 'PlannerController@update')->name("plans.update");
        Route::delete('planner/{plan}', 'PlannerController@destroy')->name("plans.destroy");
        Route::get('/planner/favorite/{plan}', 'PlannerController@addToFavorites')->name("plans.favorite");
    });

// Route::get('/telegram/connect', 'TelegramController@connect')->name('telegram.connect');
// Route::get('/telegram/callback', 'TelegramController@callback')->name('telegram.callback');

    Route::get('/about', function () {
        return view('about');
    })->name('about');


// PLANNER
    Route::group(['middleware' => ['auth:sanctum', 'isActiveUser']], function () {
        Route::get('/settings', 'SettingsController@index')->name("settings.index");
        Route::post('/settings/update', 'SettingsController@update')->name("settings.update");
    });

});


/////////////////////////////////////////////////////////////////////////////////////////////////////////
// ADMIN ROUTES
/////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:sanctum', 'is.admin']], function () {
    Route::resource('categories', CategoryController::class);

    Route::get('/clear-cache', function () {
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        return 'DONE'; //Return anything
    });

    Route::get('/history', 'HistoryController@index')->name("history.index");


    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/support', 'SupportController@index')->name("support.index");
    Route::get('/support/create/{supportMessage}', 'SupportController@create')->name("support.create");
    Route::post('/support/reply', 'SupportController@reply')->name("support.reply");

// USERS
    Route::get('/users', 'UserController@index')->name("users.index");
    Route::post('/users/update/{user}', 'UserController@update')->name("users.update");

//BLOCKED USERS
    Route::get('/blocked/list', 'BlockedUsersController@getBlockedUsers')->name("blocked.users");
    Route::post('/block', 'BlockedUsersController@blockUser')->name("block.user");
    Route::delete('/block/{block}', 'BlockedUsersController@unblockUser')->name("unblock.user");


    Route::get('/blocked/create', 'BlockedUsersController@createBlockView')->name("blocked.create.view");
    Route::post('/blocked/create', 'BlockedUsersController@createBlock')->name("block.store");



});



Route::resource('yt', YoutubeVideoController::class);
