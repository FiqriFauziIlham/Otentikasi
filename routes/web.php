<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/',[LoginController::class, 'login'])->name('login');
Route::post('actionLogin',[LoginController::class, 'actionLogin'])->name('actionLogin');
Route::post('create',[LoginController::class, 'create'])->name('create')->middleware('throttle:5,1');
Route::get('registrasi',[LoginController::class, 'registrasi'])->name('registrasi');

Route::get('home',[HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionLogout',[LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('forgot-password/send-code', [ForgotPasswordController::class, 'sendResetCode'])->name('forgot-password.send-code');
Route::post('forgot-password/verify-code', [ForgotPasswordController::class, 'verifyResetCode'])->name('forgot-password.verify-code');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password.post');





