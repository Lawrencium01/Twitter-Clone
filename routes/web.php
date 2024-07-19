<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix'=> 'ideas/', 'as' => 'ideas.'], function () {

    //Route::get('{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {
        //Route::post('', [IdeaController::class,'store'])->name('store');

        //Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

        //Route::put('{idea}', [IdeaController::class, 'update'])->name('update');

        //Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('destroy');

        //Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
       
    
});

Route::get('lang/{lang}', function ($lang) {
    app()->setLocale('lang');
    session()->put('locale', $lang);
    app()->getLocale();

    return redirect()->route('dashboard');
})->name('lang');

Route::resource('ideas', IdeaController::class)->except(['index','create','show'])->middleware('auth');

Route::resource('ideas', IdeaController::class)->only(['show']);

Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

//Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::resource('users', UserController::class)->only('show');

Route::resource('users', UserController::class)->only('edit', 'update')->middleware('auth');

Route::get('/profile', [UserController::class,'profile'])->name('profile')->middleware('auth');

Route::post('users/{user}/follow', [FollowerController::class,'follow'])->name('users.follow')->middleware('auth');

Route::post('users/{user}/unfollow', [FollowerController::class,'unfollow'])->name('users.unfollow')->middleware('auth');

Route::post('ideas/{idea}/like', [IdeaLikeController::class,'like'])->name('ideas.like')->middleware('auth');

Route::post('ideas/{idea}/unlike', [IdeaLikeController::class,'unlike'])->name('ideas.unlike')->middleware('auth');

Route::get('/feed', [FeedController::class, '__invoke'])->name('feed')->middleware('auth');

Route::get('/terms', function(){
    return view('terms');
});

Route::middleware(['auth','can:admin'])->prefix('/admin')->as('admin.')->group(function(){
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard'); 
    Route::resource('users', AdminUserController::class)->only('index'); 
    Route::resource('ideas', AdminIdeaController::class)->only('index'); 
    Route::resource('comments', AdminCommentController::class)->only('index','destroy'); 
});

