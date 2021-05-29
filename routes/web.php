<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::resource('roles', 'RolesController');

    // Users
    Route::resource('users', 'UsersController');

    // Brand
    Route::resource('brands', 'BrandController');

    // Medicines Categories
    Route::post('medicines-categories/media', 'MedicinesCategoriesController@storeMedia')->name('medicines-categories.storeMedia');
    Route::post('medicines-categories/ckmedia', 'MedicinesCategoriesController@storeCKEditorImages')->name('medicines-categories.storeCKEditorImages');
    Route::resource('medicines-categories', 'MedicinesCategoriesController');

    // Medicines
    Route::post('medicines/media', 'MedicinesController@storeMedia')->name('medicines.storeMedia');
    Route::post('medicines/ckmedia', 'MedicinesController@storeCKEditorImages')->name('medicines.storeCKEditorImages');
    Route::resource('medicines', 'MedicinesController');

    // Customer Detail
    Route::resource('customer-details', 'CustomerDetailController');

    // Order
    Route::resource('orders', 'OrderController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Pharmacy
    Route::resource('pharmacies', 'PharmacyController');

    // Covid Post
    Route::post('covid-posts/media', 'CovidPostController@storeMedia')->name('covid-posts.storeMedia');
    Route::post('covid-posts/ckmedia', 'CovidPostController@storeCKEditorImages')->name('covid-posts.storeCKEditorImages');
    Route::resource('covid-posts', 'CovidPostController');

    // Pharmacy Medicines
    Route::post('pharmacy-medicines/media', 'MedicinesController@storeMedia')->name('pharmacy-medicines.storeMedia');
    Route::post('pharmacy-medicines/ckmedia', 'MedicinesController@storeCKEditorImages')->name('pharmacy-medicines.storeCKEditorImages');
    Route::resource('pharmacy-medicines', 'PharmacyMedicinesController');

    // Pharmacy Orders
    Route::resource('pharmacy-orders', 'PharmacyOrdersController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
