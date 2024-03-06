<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AdminController;

/* Auth routes */

Auth::routes();

/* User dashboard */ 

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'save_data'])->name('home-save');

Route::get('/home/models/own', [HomeController::class, 'own_ads'])->name('home-own');
Route::get('/home/models/own/create', [AdsController::class, 'create_page'])->name('ad-create-page');
Route::post('/home/models/own/create', [AdsController::class, 'create'])->name('ad-create');

Route::get('/home/models/bought', [HomeController::class, 'bought_ads'])->name('home-bought');
Route::get('/home/reviews', [HomeController::class, 'reviews'])->name('home-reviews');
Route::get('/home/stat', [HomeController::class, 'stats'])->name('home-stats');

/* Admin dashboard */

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/ads', [AdminController::class, 'ad_editor'])->name('ad-editor');
Route::get('/admin/reviews', [AdminController::class, 'review_editor'])->name('review-editor');

// AD pages

Route::get('/ads/edit/{ad}', [AdminController::class, 'ad_edit'])->name('ad-edit');
Route::patch('/ads/edit/{ad}', [AdminController::class, 'ad_update'])->name('ad-update');

Route::delete('/ads/{ad}', [AdminController::class, 'ad_delete'])->name('ad-delete');

// Review pages
Route::get('/reviews/create', [AdminController::class, 'review_create'])->name('review-create');
Route::post('/reviews/create', [AdminController::class, 'review_store'])->name('review-store');

Route::get('/reviews/edit/{review}', [AdminController::class, 'review_edit'])->name('review-edit');
Route::patch('/reviews/edit/{review}', [AdminController::class, 'review_update'])->name('review-update');

Route::delete('/reviews/{review}', [AdminController::class, 'review_delete'])->name('review-delete');

/* Main pages */

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/ads', [MainController::class, 'ads'])->name('ads');
Route::get('/{ad}', [MainController::class, 'detail'])->name('ad-detail');