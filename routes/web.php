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

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Service
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServiceController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServiceController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::resource('services', 'ServiceController');

    // Service Provider
    Route::delete('service-providers/destroy', 'ServiceProviderController@massDestroy')->name('service-providers.massDestroy');
    Route::post('service-providers/media', 'ServiceProviderController@storeMedia')->name('service-providers.storeMedia');
    Route::post('service-providers/ckmedia', 'ServiceProviderController@storeCKEditorImages')->name('service-providers.storeCKEditorImages');
    Route::resource('service-providers', 'ServiceProviderController');

    // Booking Detail
    Route::delete('booking-details/destroy', 'BookingDetailController@massDestroy')->name('booking-details.massDestroy');
    Route::resource('booking-details', 'BookingDetailController');

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Payment Transaction
    Route::delete('payment-transactions/destroy', 'PaymentTransactionController@massDestroy')->name('payment-transactions.massDestroy');
    Route::resource('payment-transactions', 'PaymentTransactionController');

    // Service Schedule
    Route::delete('service-schedules/destroy', 'ServiceScheduleController@massDestroy')->name('service-schedules.massDestroy');
    Route::resource('service-schedules', 'ServiceScheduleController');

    // Service Provider Schedule
    Route::delete('service-provider-schedules/destroy', 'ServiceProviderScheduleController@massDestroy')->name('service-provider-schedules.massDestroy');
    Route::resource('service-provider-schedules', 'ServiceProviderScheduleController');

    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
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
