<?php

use App\Models\Delivery;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/customer', function (Request $request) {
    return User::find($request->kodeRahasia);
});

Route::post('/inventory', function (Request $request) {
    return inventory::find($request->kodeRahasia);
});

Route::post('/transaction', function (Request $request) {
    return Transaction::find($request->kodeRahasia);
});

Route::post('/delivery-order', function (Request $request) {
    return Delivery::find($request->kodeRahasia);
});

Route::post('/customer-delete', function (Request $request) {
    return User::find($request->kodeRahasia)->delete();
});

Route::post('/inventory-delete', function (Request $request) {
    return inventory::find($request->kodeRahasia)->delete();
});

Route::post('/transaction-delete', function (Request $request) {
    return Transaction::find($request->kodeRahasia)->delete();
});

Route::post('/delivery-order-delete', function (Request $request) {
    return Delivery::find($request->kodeRahasia)->delete();
});
