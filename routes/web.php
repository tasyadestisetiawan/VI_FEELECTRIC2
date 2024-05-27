<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminBootcampController;
use App\Http\Controllers\Admin\AdminCoffeeBeanController;
use App\Http\Controllers\Admin\AdminCoffeeMachineController;
use App\Http\Controllers\Admin\AdminProductCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;

Route::get('/', function () {
    return view('home/index');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Product Routes Resource
    Route::resource('products', AdminProductController::class);

    // Product Categories Resource
    Route::resource('categories', AdminProductCategoryController::class);

    // Product CoffeeBean Resource
    Route::resource('coffee-beans', AdminCoffeeBeanController::class);

    // Product CoffeeMachine Resource
    Route::resource('coffee-machines', AdminCoffeeMachineController::class);

    // Courses Routes Resource
    Route::resource('courses', AdminCourseController::class);

    // Bootcamp Routes Resource
    Route::resource('bootcamps', AdminBootcampController::class);

    // Orders Routes Resource
    Route::resource('orders', AdminOrderController::class);
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Product Routes Resource
    Route::resource('user/products', UserProductController::class);

    // Cart Routes Resource
    Route::resource('user/cart', UserCartController::class);

    // Checkout Routes
    Route::get('/user/checkout', [UserCartController::class, 'checkout'])->name('user.checkout');

    // Orders Routes Resource
    Route::resource('user/orders', UserOrderController::class);

    // Profile Routes
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    // Update Profile View
    Route::get('/user/profile/edit', [UserController::class, 'updateProfileView'])->name('user.profile.edit');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    // Address Routes
    Route::get('/user/address', [UserController::class, 'address'])->name('user.address');

    // Address Create
    Route::get('/user/address/create', [UserController::class, 'createAddress'])->name('user.address.create');

    // Address Store
    Route::post('/user/address', [UserController::class, 'storeAddress'])->name('user.address.store');

    // Address Edit
    Route::get('/user/address/{id}/edit', [UserController::class, 'editAddress'])->name('user.address.edit');

    // Address Update
    Route::put('/user/address/{id}', [UserController::class, 'updateAddress'])->name('user.address.update');

});


require __DIR__ . '/auth.php';
