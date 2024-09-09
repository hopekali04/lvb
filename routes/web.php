<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedusaController;
use App\Http\Controllers\authMedController;
use App\Http\Controllers\collectionsController;
use App\Http\Controllers\QuantityController;
//use App\Http\Controllers\productsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariationsController;
use App\Http\Controllers\VariationOptionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\viewController;
use App\Http\Controllers\OrderItemsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Categories
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/fetch/categories', [CategoriesController::class, 'fetchAllCategoriesWithProducts']);
Route::post('/api/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('category.show');

// Products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/{id}', [viewController::class, 'loadViewProd']);
Route::get('/api/products/{id}', [ProductController::class, 'fetchOneProduct']);
Route::get('/api/product/{id}', [ProductController::class, 'getProduct']);
Route::post('/api/products', [ProductController::class, 'createProductWithImg']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Product Variations
Route::get('/product-variations', [ProductVariationsController::class, 'index']);
Route::get('/product-variations/{id}', [ProductVariationsController::class, 'show']);
Route::post('/product-variations', [ProductVariationsController::class, 'store']);
Route::put('/product-variations/{id}', [ProductVariationsController::class, 'update']);
Route::delete('/product-variations/{id}', [ProductVariationsController::class, 'destroy']);

// Variation Options
Route::get('/variation-options', [VariationOptionsController::class, 'index']);
Route::get('/variation-options/{id}', [VariationOptionsController::class, 'show']);
Route::post('/variation-options', [VariationOptionsController::class, 'store']);
Route::put('/variation-options/{id}', [VariationOptionsController::class, 'update']);
Route::delete('/variation-options/{id}', [VariationOptionsController::class, 'destroy']);

// Orders
Route::get('/orders', [OrdersController::class, 'index']);
Route::get('/orders/{id}', [OrdersController::class, 'show']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::put('/orders/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);

// Order Items
Route::get('/order-items', [OrderItemsController::class, 'index']);
Route::get('/order-items/{id}', [OrderItemsController::class, 'show']);
Route::post('/order-items', [OrderItemsController::class, 'store']);
Route::put('/order-items/{id}', [OrderItemsController::class, 'update']);
Route::delete('/order-items/{id}', [OrderItemsController::class, 'destroy']);

Route::get('/medusa-data', [MedusaController::class, 'getData']);
Route::get('/medusa/data', [authMedController::class, 'getMedusaCollections']);
Route::get('/medusa/prod', [authMedController::class, 'getMedusaProducts']);
Route::get('/landing-data', [collectionsController::class, 'getAll']);
//Route::get('/product/{id}', [productsController::class, 'getByID']);
Route::get('/collection/{id}', [collectionsController::class, 'getByID']);

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'process'])->name('checkout.process')->middleware('web');

//Route::post('/process-checkout', [CartController::class, 'processCheckout']);
Route::post('/process-checkout', [paymentController::class, 'checkout'])
    ->name('process.checkout');

Route::get('/handle-payment', [paymentController::class, 'handlePaymentReturn'])
    ->name('process.payment');
    
Route::get('/order/confirmation/{order}', [paymentController::class, 'orderConfirmation'])
    ->name('order.confirmation');
Route::get('/order/failed/{order}', [paymentController::class, 'failed'])->name('order.failed');

Route::get('/', [CategoriesController::class, 'loadhome']);
Route::get('/n', function () {
    //return "Hello World";
    //return view('hello');
    return view('welcome');
});
Route::get('/payment', function () {
    return view('payment');
});
Route::get('/shop', [collectionsController::class, 'loadShop'])->name('shop');
Route::get('/categories/{id}', [collectionsController::class, 'loadCollection'])->name('collection.view');
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/faq', function () {
    return view('faq');
});
Route::get('/try', function () {
    return view('hover');
});
Route::get('/test', function () {
    return view('test');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/products', [App\Http\Controllers\HomeController::class, 'prod'])->name('home');
Route::get('/admin/categories', [App\Http\Controllers\HomeController::class, 'cat'])->name('home');
Route::get('/admin/collections', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
Route::get('/admin/orders/{id}', [App\Http\Controllers\HomeController::class, 'viewOrder'])->name('view.order');
Route::post('/admin/orders/{id}/confirm', [App\Http\Controllers\HomeController::class, 'confirmOrder'])->name('confirm.order');
Route::get('/admin/customers', [App\Http\Controllers\HomeController::class, 'customers'])->name('home');
