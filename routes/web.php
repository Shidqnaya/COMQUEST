<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\OnlyAdminMiddleware;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\CustomizeController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\BabController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\LihatQuizController;
use App\Http\Controllers\ReviewQuizController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserItemController;

Route::get('/',[ AuthController::class, 'registerpage']);

Route::get('/auth',[AuthController::class, 'loginpage'])->name('loginpage');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/dashboard', [AuthController::class, 'redirect'])->middleware(Authenticate::class)->name('dashboard');

Route::middleware([Authenticate::class])->group(function () {
    // Routes that require authentication (user routes)
    Route::get('user/dashboard',[UserController::class,'dashboard'])->name('user.dashboard');
    Route::get('user/profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('user/leaderboard',[LeaderboardController::class,'userindex'])->name('user.leaderboard');
    Route::get('user/customize',[CustomizeController::class,'userindex'])->name('user.customize');
    Route::get('user/toko',[UserController::class,'toko'])->name('user.toko');
    Route::get('user/matkul/{matkul}/babs', [ChapterController::class, 'index'])->name('user.babs.index');

    //search matkul
    Route::get('/user/search', [MatkulController::class, 'usersearch'])->name('user.matkul.search');


    //item
    Route::get('user/item/purchase/{item}', [ItemController::class, 'purchase'])->name('user.item.purchase');

    

    // User quiz routes
    Route::get('user/matkul/{matkul}/bab/{bab}/quizzes', [LihatQuizController::class, 'index'])->name('user.quizzes.index');
    Route::get('user/matkul/{matkul}/bab/{bab}/attempt/quiz/{quiz}', [LihatQuizController::class, 'attempt'])->name('user.quizzes.attempt');
    Route::post('user/matkul/{matkul}/bab/{bab}/attempt/quiz/{quiz}', [LihatQuizController::class, 'submit'])->name('user.quizzes.submit');



    // Profile update route
    Route::put('user/profile/{id}', [UserController::class, 'update'])->name('user.profile.update');

});

Route::middleware(OnlyAdminMiddleware::class)->group(function(){
    //admin routes
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('admin/leaderboard',[LeaderboardController::class,'adminindex'])->name('admin.leaderboard');
    Route::get('admin/customize',[CustomizeController::class,'adminindex'])->name('admin.customize');
    Route::get('admin/toko',[AdminController::class,'toko'])->name('admin.toko');

    Route::get('admin/resetscoreall',[AdminController::class,'resetscoreall'])->name('admin.resetscoreall');

    //search matkul
    Route::get('/admin/search', [MatkulController::class, 'adminsearch'])->name('admin.matkul.search');

    // Profile update route
    Route::put('admin/profile/{id}', [AdminController::class, 'update'])->name('admin.profile.update');

    // Matkul routes
    Route::get('admin/matkul/create', [MatkulController::class, 'create'])->name('admin.matkul.create');
    Route::post('admin/matkul/store', [MatkulController::class, 'store'])->name('admin.matkul.store');
    Route::get('admin/matkul/{matkul}/edit', [MatkulController::class, 'edit'])->name('admin.matkul.edit');
    Route::put('admin/matkul/{matkul}', [MatkulController::class, 'update'])->name('admin.matkul.update');
    Route::delete('admin/matkul/{matkul}', [MatkulController::class, 'destroy'])->name('admin.matkul.destroy');

    /// Bab routes
    Route::get('admin/matkul/{matkul}/babs/create', [BabController::class, 'create'])->name('admin.bab.create');
    Route::post('admin/matkul/{matkul}/babs', [BabController::class, 'store'])->name('admin.bab.store');
    Route::put('admin/matkul/{matkul}/babs/{bab}', [BabController::class, 'update'])->name('admin.bab.update');
    Route::delete('admin/matkul/{matkul}/babs/{bab}', [BabController::class, 'destroy'])->name('admin.bab.destroy');

    // Quiz routes
    Route::get('admin/bab/{bab}/quizzes/create', [KuisController::class, 'create'])->name('admin.quiz.create');
    Route::get('admin/bab/{bab}/quizzes/addSoal/{quiz}', [KuisController::class, 'addSoal'])->name('admin.quiz.addSoal');
    Route::post('admin/bab/{bab}/quizzes', [KuisController::class, 'store'])->name('admin.quiz.store');
    Route::put('admin/bab/{bab}/quizzes/{quiz}', [KuisController::class, 'update'])->name('admin.quiz.update');
    Route::delete('admin/bab/{bab}/quizzes/{quiz}', [KuisController::class, 'destroy'])->name('admin.quiz.destroy');

    // soal routes
    Route::post('admin/bab/{bab}/addsoal/{quiz}', [SoalController::class, 'store'])->name('admin.soal.store');
    Route::post('admin/addopsi/{soal}', [SoalController::class, 'addopsi'])->name('admin.opsi.store');
    Route::put('admin/bab/{bab}/quizzes/{quiz}/soal/{question}', [SoalController::class, 'update'])->name('admin.soal.update');
    Route::delete('admin/bab/{bab}/quizzes/{quiz}/soal/{question}', [SoalController::class, 'destroy'])->name('admin.soal.destroy');
    Route::delete('admin/bab/{bab}/quizzes/{quiz}/soal/{question}/opsi/{answer}', [SoalController::class, 'destroyopsi'])->name('admin.opsi.destroy');
    Route::put('admin/bab/{bab}/quizzes/{quiz}/soal/{question}/opsi/{answer}', [SoalController::class, 'updateopsi'])->name('admin.opsi.update');

    //item
    Route::post('admin/item/create', [ItemController::class, 'create'])->name('admin.item.create');
    Route::put('admin/item/{item}/update', [ItemController::class, 'update'])->name('admin.item.update');
Route::delete('admin/item/{item}/delete', [ItemController::class, 'destroy'])->name('admin.item.destroy');


});