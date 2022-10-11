<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/redirect', [AdminController::class, 'redirect'])->name('redirect');

    route::get('/category', [AdminController::class, 'view_category']);
    route::get('/category/{id}', [AdminController::class, 'category']);
    route::post('/add_category', [AdminController::class, 'add_category']);
    route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

    route::get('/supplier', [AdminController::class, 'view_supplier']);
    route::get('/supplier/{id}', [AdminController::class, 'supplier']);
    route::post('/add_supplier', [AdminController::class, 'add_supplier']);
    route::get('/delete_supplier/{id}', [AdminController::class, 'delete_supplier']);

    route::get('/add_product', [ProductController::class, 'add_product']);
    route::post('/upload_product', [ProductController::class, 'upload_product']);
    route::get('/all_product', [ProductController::class, 'all_product'])->name('all_product');
    route::get('/all_product_table', [ProductController::class, 'all_product_table']);
    route::get('/all_product/{id}', [ProductController::class, 'view_product']);
    route::get('/update_product/{id}', [ProductController::class, 'update_product']);
    route::post('/update_product_confirm/{id}', [ProductController::class, 'update_product_confirm']);

    route::get('/order', [OrderController::class, 'all_order']);
    route::get('/order/{id}', [OrderController::class, 'view_order']);
    route::get('/delivered/{id}', [OrderController::class, 'delivered']);

    route::get('/pdf/{id}', [OrderController::class, 'pdf']);
    route::get('/print_pdf/{id}', [OrderController::class, 'print_pdf']);
    route::get('/send_email/{id}', [OrderController::class, 'send_email']);
    route::post('/send_user_email/{id}', [OrderController::class, 'send_user_email']);

    route::get('/search', [ProductController::class, 'search'])->name('search');
    
    route::get('/customer', [AdminController::class, 'allcustomer']);
    route::get('/customer/{id}', [AdminController::class, 'customer']);
});

// 

Route::get('/', [HomeController::class, 'index'])->name('index');
route::get('/products', [HomeController::class, 'products'])->name('products');
route::get('/products/{id}', [HomeController::class, 'product_details']);

route::get('/product_category/{category_name}', [HomeController::class, 'category'])->name('category');
route::post('/searchproduct', [HomeController::class, 'searchproduct'])->name('searchproduct');

route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
route::get('/cart', [HomeController::class, 'show_cart']);
route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

route::get('/confirm_cart', [HomeController::class, 'confirm_cart']);
route::post('/checkout', [HomeController::class, 'checkout']);

Route::get('/orders', [HomeController::class, 'order']);
Route::get('/orders/{id}', [HomeController::class, 'order_detail']);

Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/update_profile', [HomeController::class, 'update_profile']);
Route::post('/update_profile_confirm', [HomeController::class, 'update_profile_confirm']);
