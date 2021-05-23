<?php

// , 'middleware' => ['auth:sanctum']

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
   
    // Brand
    Route::apiResource('brands', 'BrandApiController');

    // Medicines Categories
    Route::post('medicines-categories/media', 'MedicinesCategoriesApiController@storeMedia')->name('medicines-categories.storeMedia');
    Route::apiResource('medicines-categories', 'MedicinesCategoriesApiController');

    // Medicines
    Route::post('medicines/media', 'MedicinesApiController@storeMedia')->name('medicines.storeMedia');
    Route::apiResource('medicines', 'MedicinesApiController');

    // Customer Detail
    Route::apiResource('customer-details', 'CustomerDetailApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');

    // Pharmacy
    Route::apiResource('pharmacies', 'PharmacyApiController');

    // Covid Post
    Route::post('covid-posts/media', 'CovidPostApiController@storeMedia')->name('covid-posts.storeMedia');
    Route::apiResource('covid-posts', 'CovidPostApiController');
});

