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
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Brand
    Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
    Route::resource('brands', 'BrandController');

    // Medicines Categories
    Route::delete('medicines-categories/destroy', 'MedicinesCategoriesController@massDestroy')->name('medicines-categories.massDestroy');
    Route::post('medicines-categories/media', 'MedicinesCategoriesController@storeMedia')->name('medicines-categories.storeMedia');
    Route::post('medicines-categories/ckmedia', 'MedicinesCategoriesController@storeCKEditorImages')->name('medicines-categories.storeCKEditorImages');
    Route::resource('medicines-categories', 'MedicinesCategoriesController');

    // Medicines
    Route::delete('medicines/destroy', 'MedicinesController@massDestroy')->name('medicines.massDestroy');
    Route::post('medicines/media', 'MedicinesController@storeMedia')->name('medicines.storeMedia');
    Route::post('medicines/ckmedia', 'MedicinesController@storeCKEditorImages')->name('medicines.storeCKEditorImages');
    Route::resource('medicines', 'MedicinesController');

    // Customer Detail
    Route::delete('customer-details/destroy', 'CustomerDetailController@massDestroy')->name('customer-details.massDestroy');
    Route::resource('customer-details', 'CustomerDetailController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    // Pharmacy
    Route::delete('pharmacies/destroy', 'PharmacyController@massDestroy')->name('pharmacies.massDestroy');
    Route::resource('pharmacies', 'PharmacyController');

    // Covid Post
    Route::delete('covid-posts/destroy', 'CovidPostController@massDestroy')->name('covid-posts.massDestroy');
    Route::post('covid-posts/media', 'CovidPostController@storeMedia')->name('covid-posts.storeMedia');
    Route::post('covid-posts/ckmedia', 'CovidPostController@storeCKEditorImages')->name('covid-posts.storeCKEditorImages');
    Route::resource('covid-posts', 'CovidPostController');

    // Pharmacy Medicines
    Route::delete('pharmacy-medicines/destroy', 'PharmacyMedicinesController@massDestroy')->name('pharmacy-medicines.massDestroy');
    Route::resource('pharmacy-medicines', 'PharmacyMedicinesController');

    // Pharmacy Customers
    Route::delete('pharmacy-customers/destroy', 'PharmacyCustomersController@massDestroy')->name('pharmacy-customers.massDestroy');
    Route::resource('pharmacy-customers', 'PharmacyCustomersController');

    // Pharmacy Orders
    Route::delete('pharmacy-orders/destroy', 'PharmacyOrdersController@massDestroy')->name('pharmacy-orders.massDestroy');
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
