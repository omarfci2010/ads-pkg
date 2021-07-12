<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Kwreach\Ads\Http\Controllers\Api\AdsController;
use Kwreach\Ads\Http\Controllers\Api\AdvertiserController;
use Kwreach\Ads\Http\Controllers\Api\CategoryController;
use Kwreach\Ads\Http\Controllers\Api\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'api'], function () {

    /** Category Routes */
    Route::group(['prefix' => 'category'], function () {
        Route::post('add', [CategoryController::class, 'add']);
        Route::get('details/{id}', [CategoryController::class, 'categoryDetails']);
        Route::get('all', [CategoryController::class, 'allCategories']);
        Route::patch('edit/{id}', [CategoryController::class, 'edit']);
        Route::delete('delete/{id}', [CategoryController::class, 'delete']);
    });

    /** Tage Routes */
    Route::group(['prefix' => 'tag'], function () {
        Route::post('add', [TagController::class, 'add']);
        Route::get('details/{id}', [TagController::class, 'categoryDetails']);
        Route::get('all', [TagController::class, 'allCategories']);
        Route::patch('edit/{id}', [TagController::class, 'edit']);
        Route::delete('delete/{id}', [TagController::class, 'delete']);
    });

    /** Ads Routes */
    Route::group(['prefix' => 'ads'], function () {
        Route::post('add', [AdsController::class, 'add']);
        Route::get('details/{id}', [AdsController::class, 'adDetails']);
        Route::post('all', [AdsController::class, 'allAds']);
        Route::patch('edit/{id}', [AdsController::class, 'edit']);
        Route::delete('delete/{id}', [AdsController::class, 'delete']);

        #Advertiser Ads
        Route::get('advertiser/{advertiser_id}', [AdsController::class, 'advertiserAds']);
    });

});

