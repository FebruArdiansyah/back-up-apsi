<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductCartController;

Route::redirect('/loginadmin', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('admin.home');
});

Route::get('/', [ProductCartController::class, 'index'])->name('index');
Route::post('/cart/add', [ProductCartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [ProductCartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [ProductCartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [ProductCartController::class, 'showCart'])->name('checkout.index');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success'); // Added this line
Route::get('/order/{id}', [CheckoutController::class, 'showOrder'])->name('order.show');
Route::post('/midtrans.checkout', [CheckoutController::class, 'checkout'])->name('midtrans.checkout');
Route::get('/order/{id}', [CheckoutController::class, 'showOrder'])->name('order.show');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
// Route::post('/midtrans-callback', [CheckoutController::class, 'callback'])->name('midtrans.callback');


Auth::routes(['register' => false]);

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

     // product
     Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
     Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
     Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
     Route::resource('products', 'ProductController');

     // order
     Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
     Route::post('orders/media', 'OrderController@storeMedia')->name('orders.storeMedia');
     Route::post('orders/ckmedia', 'OrderController@storeCKEditorImages')->name('orders.storeCKEditorImages');
     Route::resource('orders', 'OrderController');

     // history order
    // Route::delete('history_orders/destroy', 'HistoryOrderController@massDestroy')->name('history_orders.massDestroy');
    // Route::resource('history_orders', 'HistoryOrderController');

    // history order booking manual
    Route::get('admin/history_orders', [App\Http\Controllers\Admin\OrderController::class, 'history'])->name('admin.history_orders.index');
    Route::delete('history_orders/destroy', 'HistoryOrderController@massDestroy')->name('history_orders.massDestroy');
    Route::resource('history_orders', 'HistoryOrderController');
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


