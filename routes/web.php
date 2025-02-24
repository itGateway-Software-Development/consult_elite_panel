<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ActivityManagement\BlogController;
use App\Http\Controllers\Admin\ContentManagement\SuccessRateController;
use App\Http\Controllers\Admin\ContentManagement\SuccessStoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/', function () {return redirect()->route('admin.home');});

Route::group(['middleware' => ['auth', 'prevent-back-history'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [ProfileController::class, 'dashboard'])->name('home');

    //permission
    Route::get('/permission-datatable', [PermissionController::class, 'dataTable']);
    Route::resource('permissions', PermissionController::class);

    //roles
    Route::get('/roles-datatable', [RolesController::class, 'dataTable']);
    Route::resource('roles', RolesController::class);

    //users
    Route::get('/users-datatable', [UserController::class, 'dataTable']);
    Route::resource('users', UserController::class);

    // content management
    Route::group(['prefix' => 'content-management'], function() {
        //success rate
        Route::post('update-success-rate/{successRate}', [SuccessRateController::class, 'updateSuccessRate']);
        Route::get('/success-rate/datatable-lists', [SuccessRateController::class, 'successRateLists']);
        Route::resource('success-rate', SuccessRateController::class);

        // success story
        Route::post('update-success-story/{successStory}', [SuccessStoryController::class, 'updateSuccessStory']);
        Route::get('/success-story/datatable-lists', [SuccessStoryController::class, 'successStoryLists']);
        Route::resource('success-story', SuccessStoryController::class);
    });

    // activity management
    Route::group(['prefix' => 'activity-management'], function() {
        //blog
        Route::post('/update-blogs/{blog}', [BlogController::class, 'updateBlog']);
        Route::get('blogs/datatable-lists', [BlogController::class, 'blogLists']);
        Route::resource('blogs', BlogController::class);
    });
});

require __DIR__ . '/auth.php';
