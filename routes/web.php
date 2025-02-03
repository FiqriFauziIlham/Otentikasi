<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/',[LoginController::class, 'login'])->name('login');
Route::post('actionLogin',[LoginController::class, 'actionLogin'])->name('actionLogin');
Route::post('create',[LoginController::class, 'create'])->name('create')->middleware('throttle:5,1');
Route::get('registrasi',[LoginController::class, 'registrasi'])->name('registrasi');

Route::get('home',[HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionLogout',[LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');



