<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ActivityManagement\BlogController;

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

    Route::group(['prefix' => 'activity-management'], function() {
        Route::post('/update-blogs/{blog}', [BlogController::class, 'updateBlog']);
        Route::get('blogs/datatable-lists', [BlogController::class, 'blogLists']);
        Route::resource('blogs', BlogController::class);
    });
});

require __DIR__ . '/auth.php';
