<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MainController::class, 'index'])->name('index');
// Route::get('/dashboard', [MainController::class, 'index'])->name('index');
Route::get('/customer', [MainController::class, 'customer_index'])->name('customer_index');
Route::get('/inventory', [MainController::class, 'inventory_index'])->name('inventory_index');
Route::get('/transaction', [MainController::class, 'transaction_index'])->name('transaction_index');
Route::get('/delivery-order', [MainController::class, 'delivery_order_index'])->name('delivery_order_index');

Route::get('/modal/customer', [MainController::class, 'OpenModal'])->name('Customer_Modal');
Route::get('/modal/inventory', [MainController::class, 'OpenModal'])->name('inventory_Modal');
Route::get('/modal/transaction', [MainController::class, 'OpenModal'])->name('transaction_Modal');
Route::get('/modal/delivery-order', [MainController::class, 'OpenModal'])->name('delivery_order_Modal');

Route::post('/modal/customer/save', [MainController::class, 'customer_save'])->name('Customer_Save');
Route::post('/modal/customer/update', [MainController::class, 'customer_update'])->name('Customer_Update');

Route::post('/modal/inventory/save', [MainController::class, 'inventory_save'])->name('Inventory_Save');
Route::post('/modal/inventory/update', [MainController::class, 'inventory_update'])->name('Inventory_Update');

Route::post('/modal/transaction/save', [MainController::class, 'transaction_save'])->name('Transaction_Save');
Route::post('/modal/transaction/update', [MainController::class, 'transaction_update'])->name('Transaction_Update');

Route::post('/modal/delivery-order/save', [MainController::class, 'delivery_order_save'])->name('Delivery_Order_Save');
Route::post('/modal/delivery-order/update', [MainController::class, 'delivery_order_update'])->name('Delivery_Order_Update');
