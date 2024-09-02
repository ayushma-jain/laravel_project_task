<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories',[App\Http\Controllers\CategoryController::class,'index'])->name('categories.index');

Route::post('/categories',[App\Http\Controllers\CategoryController::class,'store'])->name('categories.store');

Route::delete('/categories',[App\Http\Controllers\CategoryController::class,'destroy'])->name('categories.destroy');

Route::get('/availabilities',[App\Http\Controllers\AvailabilityController::class,'index'])->name('availabilities.index');

Route::post('/availabilities',[App\Http\Controllers\AvailabilityController::class,'store'])->name('availabilities.store');

Route::get('/create-availabilities',[App\Http\Controllers\AvailabilityController::class,'createAvailabilityView'])->name('create-availabilities')->middleware('auth');

Route::resource('posts',App\Http\Controllers\PostController::class);