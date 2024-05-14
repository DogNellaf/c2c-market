<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AdminController;

/* Auth routes */

Auth::routes();

/* User dashboard */ 

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::post('/home', [HomeController::class, 'save_data'])->name('home.index.save');

Route::get('/home/models/own', [HomeController::class, 'own_ads'])->name('home.ads.own');
Route::get('/home/models/bought', [HomeController::class, 'bought_ads'])->name('home.ads.bought');
Route::get('/home/reviews', [HomeController::class, 'reviews'])->name('home.reviews');
Route::get('/home/stat', [HomeController::class, 'stats'])->name('home.stats');

Route::get('/home/models/own/create', [HomeController::class, 'ads_create_page'])->name('home.ads.create.page');
Route::post('/home/models/own/create', [HomeController::class, 'ads_create_method'])->name('home.ads.create.method');

Route::get('/home/models/own/{ad}/edit', [HomeController::class, 'ads_edit_page'])->name('home.ads.edit.page');
Route::patch('/home/models/own/{ad}/edit', [HomeController::class, 'ads_edit_method'])->name('home.ads.edit.method');
Route::patch('/home/models/own/{ad}/hide', [HomeController::class, 'ads_hide_method'])->name('home.ads.hide.method');
Route::patch('/home/models/own/{ad}/show', [HomeController::class, 'ads_show_method'])->name('home.ads.show.method');

/* Admin dashboard */

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/ads', [AdminController::class, 'ad_editor'])->name('admin.ads.editor');
Route::get('/admin/reviews', [AdminController::class, 'review_editor'])->name('admin.ads.reviews.editor');

// AD pages

Route::get('/ads/edit/{ad}', [AdminController::class, 'ad_edit'])->name('admin.ads.edit.page');
Route::patch('/ads/edit/{ad}', [AdminController::class, 'ad_update'])->name('admin.edit.method');

Route::delete('/ads/{ad}', [AdminController::class, 'ad_delete'])->name('admin.ads.delete.method');

// Review pages
Route::get('/home/reviews/create', [HomeController::class, 'reviews_create_page'])->name('home.reviews.create.page');
Route::post('/home/reviews/create', [HomeController::class, 'review_store'])->name('home.reviews.create.method');

Route::get('/home/reviews/edit/{review}', [HomeController::class, 'review_edit'])->name('home.reviews.edit.page');
Route::patch('/home/reviews/edit/{review}', [HomeController::class, 'review_update'])->name('home.reviews.edit.method');

Route::delete('/home/reviews/{review}', [HomeController::class, 'review_delete'])->name('home.review.delete.method');

/* Main pages */

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/ads', [MainController::class, 'ads'])->name('main.ads.list');
Route::get('/rules', [MainController::class, 'rules'])->name('main.rules');

Route::get('/ads/{ad}', [MainController::class, 'ad_detail'])->name('main.ads.detail');
Route::get('/authors/{user}', [MainController::class, 'user_detail'])->name('main.users.detail');

/* Buying ad */
Route::get('/ads/{ad}/buy', [MainController::class, 'buy'])->name('main.ads.buy');
Route::get('/ads/{ad}/buy/confirm', [MainController::class, 'confirm'])->name('main.ads.buy.confirm');