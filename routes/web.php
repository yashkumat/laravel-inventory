<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorController;


Route::get('/', [HomeController::class, 'index']);

Auth::routes();
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
Route::get('/toggleAdmin/{id}', [DashboardController::class, 'toggleAdmin'])->name('toggleAdmin');
Route::get('/toggleActive/{id}', [DashboardController::class, 'toggleActive'])->name('toggleActive');

Route::get('/inventory', [ItemController::class, 'inventory'])->name('inventory');
Route::get('/addItem', [ItemController::class, 'addItem'])->name('addItem');
Route::post('/addItemToInventory/{item}', [ItemController::class, 'addItemToInventory'])->name('addItemToInventory');
Route::post('/storeItem', [ItemController::class, 'storeItem'])->name('storeItem');
Route::get('/editItem/{item}', [ItemController::class, 'editItem'])->name('editItem');
Route::post('/updateItem/{item}', [ItemController::class, 'updateItem'])->name('updateItem');
Route::get('/deleteItem/{item}', [ItemController::class, 'deleteItem'])->name('deleteItem');
Route::post('/search_item', [ItemController::class, 'search_item'])->name('search_item');


Route::get('/bill', [BillController::class, 'index'])->name('bill');
Route::post('/addToBill/{item}', [BillController::class, 'addToBill'])->name('addToBill');
Route::get('/removeFromBill/{id}', [BillController::class, 'removeFromBill'])->name('removeFromBill');
Route::post('/editQuantity/{id}', [BillController::class, 'editQuantity'])->name('editQuantity');
Route::post('/addDiscount', [BillController::class, 'addDiscount'])->name('addDiscount');
Route::post('/saveBill', [BillController::class, 'saveBill'])->name('saveBill');
Route::get('/billBook', [BillController::class, 'billBook'])->name('billBook');
Route::get('/clearBill/{bill}', [BillController::class, 'clearBill'])->name('clearBill');
Route::get('/autocomplete', [BillController::class, 'autocomplete'])->name('autocomplete');
Route::get('/resetBill', [BillController::class, 'resetBill'])->name('resetBill');


Route::get('/vendor', [VendorController::class, 'index'])->name('vendor');
Route::get('/addVendor', [VendorController::class, 'addVendor'])->name('addVendor');
Route::post('/storeVendor', [VendorController::class, 'storeVendor'])->name('storeVendor');
Route::get('/vendorDetails/{id}', [VendorController::class, 'vendorDetails'])->name('vendorDetails');
Route::get('/vendorBills', [VendorController::class, 'vendorBills'])->name('vendorBills');
Route::get('/editVendor/{id}', [VendorController::class, 'editVendor'])->name('editVendor');
Route::post('/updateVendor/{id}', [VendorController::class, 'updateVendor'])->name('updateVendor');
Route::get('/clearVendorBill/{id}', [VendorController::class, 'clearVendorBill'])->name('clearVendorBill');
Route::get('/vendorItemInfo/{id}', [VendorController::class, 'vendorItemInfo'])->name('vendorItemInfo');

Route::get('userRegisteration', [DashboardController::class, 'userRegisteration'])->name('userRegisteration');
Route::post('registerUser', [DashboardController::class, 'registerUser'])->name('registerUser');




