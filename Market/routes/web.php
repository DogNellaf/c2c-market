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

Route::get('/home/models/own/create', [HomeController::class, 'ads_create_page'])->name('home.ads.create.page');
Route::post('/home/models/own/create', [HomeController::class, 'ads_create_method'])->name('home.ads.create.method');

Route::get('/home/models/own/{ad}/edit', [HomeController::class, 'ads_edit_page'])->name('home.ads.edit.page');
Route::patch('/home/models/own/{ad}/edit', [HomeController::class, 'ads_edit_method'])->name('home.ads.edit.method');
Route::patch('/home/models/own/{ad}/hide', [HomeController::class, 'ads_hide_method'])->name('home.ads.hide.method');
Route::patch('/home/models/own/{ad}/show', [HomeController::class, 'ads_show_method'])->name('home.ads.show.method');

Route::get('/home/reviews', [HomeController::class, 'reviews'])->name('home.reviews.list');

Route::get('/home/reviews/create', [HomeController::class, 'review_create_page'])->name('home.reviews.create.page');
Route::post('/home/reviews/create', [HomeController::class, 'review_create_method'])->name('home.reviews.create.method');
Route::get('/home/reviews/edit/{review}', [HomeController::class, 'review_edit_page'])->name('home.reviews.edit.page');
Route::patch('/home/reviews/edit/{review}', [HomeController::class, 'review_edit_method'])->name('home.reviews.edit.method');

Route::get('/home/stats', [HomeController::class, 'stats'])->name('home.stats');
Route::get('/home/wallet', [HomeController::class, 'wallet'])->name('home.wallet');
Route::get('/home/wallet/add', [HomeController::class, 'add_balance_page'])->name('home.wallet.add.page');
Route::post('/home/wallet/add', [HomeController::class, 'add_balance_method'])->name('home.wallet.add.method');

/* Admin dashboard */

Route::get('/admin', [AdminController::class, 'ads'])->name('admin.ads.list');
Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews.list');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders.list');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.list');

Route::patch('/admin/ads/{ad}/approve', [AdminController::class, 'ad_approve'])->name('admin.ads.approve');
Route::patch('/admin/ads/{ad}/reject', [AdminController::class, 'ad_reject'])->name('admin.ads.reject');

Route::get('/admin/reviews/{review}/detail', [AdminController::class, 'review'])->name('admin.reviews.detail');
Route::patch('/admin/reviews/{review}/approve', [AdminController::class, 'review_approve'])->name('admin.reviews.approve');
Route::patch('/admin/reviews/{review}/reject', [AdminController::class, 'review_reject'])->name('admin.reviews.reject');

Route::patch('/admin/users/{user}/unban', [AdminController::class, 'user_unban'])->name('admin.users.unban.method');
Route::patch('/admin/users/{user}/ban', [AdminController::class, 'user_ban'])->name('admin.users.ban.method');

/* Main pages */

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/ads', [MainController::class, 'ads'])->name('main.ads.list');
Route::get('/rules', [MainController::class, 'rules'])->name('main.rules');

Route::get('/ads/{ad}', [MainController::class, 'ad_detail'])->name('main.ads.detail');
Route::get('/authors/{user}', [MainController::class, 'user_detail'])->name('main.users.detail');

/* Buying ad */
Route::get('/ads/{ad}/buy', [MainController::class, 'buy'])->name('main.ads.buy');
Route::get('/ads/{ad}/buy/confirm', [MainController::class, 'confirm'])->name('main.ads.buy.confirm');