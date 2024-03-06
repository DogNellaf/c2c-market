<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/* Auth routes */

Auth::routes();

/* User dashboard */ 

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'save_data'])->name('home-save');
Route::get('/home/models/own', [HomeController::class, 'own_models'])->name('home-own');
Route::get('/home/models/bought', [HomeController::class, 'bought_models'])->name('home-bought');
Route::get('/home/reviews', [HomeController::class, 'reviews'])->name('home-reviews');
Route::get('/home/stat', [HomeController::class, 'stats'])->name('home-stats');

/* Admin dashboard */

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/ads', [AdminController::class, 'ad_editor'])->name('ad-editor');
Route::get('/admin/ads/create', [AdminController::class, 'ad_create'])->name('ad-create');
Route::delete('/admin/ads/{ad}/delete', [AdminController::class, 'ad_delete'])->name('ad-delete');
Route::patch('/admin/ads/{ad}', [AdminController::class, 'ad_update'])->name('ad-update');
Route::get('/admin/ads/edit/{ad}', [AdminController::class, 'ad_edit'])->name('ad-edit');
Route::post('/admin/ads', [AdminController::class, 'ad_store'])->name('ad-store');

Route::get('/admin/reviews', [AdminController::class, 'review_editor'])->name('review-editor');
Route::get('/admin/reviews/create', [AdminController::class, 'review_create'])->name('review-create');
Route::delete('/admin/reviews/{review}/delete', [AdminController::class, 'review_delete'])->name('review-delete');
Route::patch('/admin/reviews/{review}', [AdminController::class, 'review_update'])->name('review-update');
Route::get('/admin/reviews/edit/{review}', [AdminController::class, 'review_edit'])->name('review-edit');
Route::post('/admin/reviews', [AdminController::class, 'review_store'])->name('review-store');

/* Main pages */

Route::get('/', [MarketController::class, 'index'])->name('index');
Route::get('/ads', [MarketController::class, 'ads'])->name('ads');
Route::get('/{ad}', [MarketController::class, 'detail'])->name('ad-detail');