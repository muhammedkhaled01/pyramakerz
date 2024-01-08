<?php

use App\Http\Controllers\dashboard_user\UserDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UploadProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingController;
use App\Mail\TestMail;
use App\Models\Order;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// Landing pages

Route::get("/", [HomeController::class, 'index'])->name("home");
Route::get("product-view/{id}", [HomeController::class, 'productView'])->name("product-view");


// user profile
Route::get("profile/{id}", [UserSettingController::class, 'profile'])->name("profile");
Route::patch("update-profile/{id}", [UserSettingController::class, 'updateProfile'])->name("update-profile");

// Save product user
Route::get("upload-product", [UploadProductController::class, 'uploadProduct'])->name("upload-product")->middleware(Authenticate::class);
Route::post("store-upload-product", [UploadProductController::class, 'storeUploadProduct'])->name("store-upload-product");

Route::post("store-product-order", [HomeController::class, 'storeProductOrder'])->name("store-product-order");


Route::get('/logout', [HomeController::class, "logout"])->name("logout");


Route::get('/send-test-email', function () {
    $recipient = 'mohamedkhaled667.mk@gmail.com';
    Mail::to($recipient)->send(new TestMail());
});


// User dashboard
Route::group(['prefix' => "client", 'middleware' => ['client']], function () {
    Route::get("user-dashboard", [UserDashboardController::class, 'index'])->name("user-dashboard");
    Route::get("my-products", [UserDashboardController::class, 'myProducts'])->name("my-products");
    Route::get("my-orders", [UserDashboardController::class, 'myOrders'])->name("my-orders");
});

// admin dashboard

Route::group(['middleware' => ['admin']], function () {
    Route::get("dashboard", [DashboardController::class, 'index'])->name("dashboard");
    Route::resource('user', UserController::class);
    Route::delete("users-delete/{id}", [DashboardController::class, 'userDelete'])->name("user.delete");
    Route::resource("products", ProductsController::class);
    Route::get("product-uploaded", [DashboardController::class, 'productUploaded'])->name("product-uploaded");
    Route::patch("product-update/{id}", [UploadProductController::class, 'updateUploadProduct'])->name("product-update");
    Route::get("order", [OrderController::class, "index"])->name("order");
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name("orders.update");
    Route::get("order-pending", [OrderController::class, 'pending'])->name("order-pending");
    Route::get("order-processing", [OrderController::class, 'processing'])->name("order-processing");
    Route::get("order-completed", [OrderController::class, 'completed'])->name("order-completed");
    Route::get("order-cancelled", [OrderController::class, 'cancelled'])->name("order-cancelled");
    Route::delete("order-destroy/{id}", [OrderController::class, 'destroy'])->name("order-destroy");
});
