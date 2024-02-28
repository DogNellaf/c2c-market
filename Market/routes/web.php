<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MarketController::class, 'index'])->name('index');

Route::get('/ads', [MarketController::class, 'ads'])->name('ads');

Auth::routes();

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

Route::get('/{ad}', [MarketController::class, 'detail'])->name('ad-detail');