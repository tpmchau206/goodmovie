<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MoviesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VisitsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WatchController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Models\Visit;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::prefix('/')->name('index.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});
Route::get('/movie/{id}', [HomeController::class, 'popup'])->name('popup');
Route::get('/watch/movie/{id}', [WatchController::class, 'index'])->name('watch');
Route::post('/watch/movie/update', [WatchController::class, 'updateVideoTime'])->name('updateVideoTime');

Route::middleware('auth.check.login')->prefix('/')->name('user.')->group(function () {
    Route::get('/login', [UserController::class, 'index'])->name('login');
    Route::post('/login', [UserController::class, 'postLogin'])->name('post-login');

    Route::get('/chinh-sach-quyen-rieng-tu', function () {
        return '<h1>Chính Sách Quyền Riêng Tư</h1>';
    });

    Route::get('/login/google', [UserController::class, 'getLoginGoogle'])->name('loginGoogle');
    Route::get('/login/google/callback', [UserController::class, 'getLoginGoogleCallBack']);

    Route::get('/login/facebook', [UserController::class, 'getLoginFaceBook'])->name('loginFaceBook');

    Route::get('/login/facebook/callback', [UserController::class, 'getLoginFaceBookCallBack']);

    Route::get('/register', [UserController::class, 'getRegister'])->name('register');
    Route::post('/register', [UserController::class, 'postRegister'])->name('post-register');

    Route::get('/forget-password', [UserController::class, 'getForgetPass'])->name('get-forgetPass');
    Route::post('/forget-password', [UserController::class, 'postForgetPass'])->name('post-forgetPass');
    Route::get('/change-password/email={email}', [UserController::class, 'getChangePass'])->name('get-changePass');
    Route::post('/change-password/update', [UserController::class, 'postChangePass'])->name('post-changePass');
});
Route::get('/logout', [UserController::class, 'getLogout'])->name('logout');

Route::middleware('auth.admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('index');
    Route::get('/chart', [AdminHomeController::class, 'currentChart']);
    Route::post('/chart', [AdminHomeController::class, 'chart']);
    Route::prefix('/movies')->name('movies.')->group(function () {
        Route::get('/', [MoviesController::class, 'index'])->name('index');
        Route::get('/add', [MoviesController::class, 'add'])->name('add');
        Route::post('/add', [MoviesController::class, 'postAdd'])->name('post-add');
        Route::get('/edit/{id}', [MoviesController::class, 'getEdit'])->name('edit');
        Route::post('/edit/update', [MoviesController::class, 'postEdit'])->name('post-edit');
        Route::delete('/delete/{id}', [MoviesController::class, 'delete'])->name('delete');
    });
    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/add', [UsersController::class, 'add'])->name('add');
        Route::post('/add', [UsersController::class, 'postAdd'])->name('post-add');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('/edit/update', [UsersController::class, 'postEdit'])->name('post-edit');
    });
    Route::prefix('/track-visit')->name('visits.')->group(function () {
        Route::get('/', [VisitsController::class, 'index'])->name('index');
    });
});
