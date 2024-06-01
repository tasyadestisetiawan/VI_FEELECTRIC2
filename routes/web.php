<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\UserCoffeeController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserQuizzesController;
use App\Http\Controllers\User\UserVoucherController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\User\UserBootcampController;
use App\Http\Controllers\User\UserFeedbackController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminQuizzesController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminVoucherController;
use App\Http\Controllers\Admin\AdminBootcampController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\User\UserCoffeeBeanController;
use App\Http\Controllers\Admin\AdminOrderBeanController;
use App\Http\Controllers\User\UserReservationController;
use App\Http\Controllers\Admin\AdminCoffeeBeanController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\User\UserCoffeeMachineController;
use App\Http\Controllers\Admin\AdminOrderHistoryController;
use App\Http\Controllers\Admin\AdminOrderMachineController;
use App\Http\Controllers\Admin\AdminCoffeeMachineController;
use App\Http\Controllers\Admin\AdminProductCategoryController;
use App\Http\Controllers\Admin\AdminQuizzesQuestionsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
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

    // All Orders History Routes Resource
    Route::resource('orders-history', AdminOrderHistoryController::class);

    // Orders Coffee Bean Routes Resource
    Route::resource('orders-coffee-beans', AdminOrderBeanController::class);

    // Orders Coffee Machine Routes Resource
    Route::resource('orders-coffee-machines', AdminOrderMachineController::class);

    // Vouchers Routes Resource
    Route::resource('vouchers', AdminVoucherController::class);

    // Bootcamps Confirm Payment
    Route::put('/bootcamps/{id}/confirm-payment', [AdminBootcampController::class, 'confirmPayment'])->name('bootcamps.confirm-payment');

    // Delete participants
    Route::delete('/bootcamps/{id}/delete-participant/{user_id}', [AdminBootcampController::class, 'deleteParticipant'])->name('bootcamps.delete-participant');

    // Room Routes Resource
    Route::resource('rooms', AdminRoomController::class);

    // Reservations Routes Resource
    Route::resource('reservations', AdminReservationController::class);

    // Quizzes Routes Resource
    Route::resource('quizzes', AdminQuizzesController::class);

    // Quizzes Questions Routes Resource
    Route::resource('questions', AdminQuizzesQuestionsController::class);

    // Feedback Routes Resource
    Route::resource('feedbacks', AdminFeedbackController::class);

    // User Management Routes Resource
    Route::resource('users', AdminUserController::class);

    // Customers Management Routes Resource
    Route::resource('customers', AdminCustomerController::class);

    // Settings Routes Resource
    Route::resource('settings', AdminSettingController::class);
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Coffee Routes Resource
    Route::resource('user/coffees', UserCoffeeController::class);

    // Coffee Beans Routes Resource
    Route::resource('user/coffee-beans', UserCoffeeBeanController::class);

    // Coffee Machines Routes Resource
    Route::resource('user/coffee-machines', UserCoffeeMachineController::class);

    // Cart Routes Resource
    Route::resource('user/cart', UserCartController::class);

    // Checkout Routes
    Route::get('/user/checkout', [UserCartController::class, 'checkout'])->name('user.checkout');

    // Orders Routes Resource
    Route::resource('user/orders', UserOrderController::class);

    // Orders Upload Payment
    Route::get('/user/orders/{id}/upload-payment', [UserOrderController::class, 'uploadPaymentView'])->name('user.orders.upload-payment');

    // Orders Upload Payment
    Route::post('/user/orders/{id}/upload-payment', [UserOrderController::class, 'uploadPayment'])->name('user.orders.upload-payment.store');

    // ShowStatus Page with id order and id user
    Route::get('/user/orders/{id}/status', [UserOrderController::class, 'showStatus'])->name('user.orders.status');

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
    Route::post('/user/address', [UserController::class, 'addAddress'])->name('user.address.store');

    // Address Edit
    Route::get('/user/address/{id}/edit', [UserController::class, 'editAddress'])->name('user.address.edit');

    // Address Update
    Route::put('/user/address/{id}', [UserController::class, 'updateAddress'])->name('user.address.update');

    // Bootcamps Page
    Route::get('/user/bootcamps', [UserController::class, 'myBootcamps'])->name('user.bootcamps.index');

    // Voucher Routes Resource
    Route::resource('user/vouchers', UserVoucherController::class);

    // Bootcamps Routes Resource
    Route::resource('user/bootcamps', UserBootcampController::class);

    // Bootcamps Register
    Route::post('/user/bootcamps/{id}/register', [UserBootcampController::class, 'register'])->name('user.bootcamps.register');

    // My Bootcamps
    Route::get('/user/my-bootcamps', [UserBootcampController::class, 'myBootcamps'])->name('user.bootcamps.my');

    // Reservations Routes Resource
    Route::resource('user/reservations', UserReservationController::class);

    // My Reservations
    Route::get('/user/my-reservations', [UserReservationController::class, 'myReservations'])->name('user.reservations.my');

    // Feddbacks Routes Resource
    Route::resource('user/feedbacks', UserFeedbackController::class);
});

// All Products Route with Prefix
Route::prefix('products')->group(function () {
    Route::get('/', [UserProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [UserProductController::class, 'show'])->name('products.show');
});

// All Rooms Route with Prefix
Route::prefix('rooms')->group(function () {
    Route::get('/', [UserRoomController::class, 'index'])->name('rooms.index');
    Route::get('/{id}', [UserRoomController::class, 'show'])->name('rooms.show');
});

// All Quizzes Route with Prefix
Route::prefix('quizzes')->group(function () {
    Route::get('/', [UserQuizzesController::class, 'index'])->name('quizzes.index');
    Route::get('/{id}', [UserQuizzesController::class, 'show'])->name('quizzes.show');
});

// Google Auth
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);

require __DIR__ . '/auth.php';
