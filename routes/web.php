<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\DoctorVisitController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\TreeProductController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\VisitPeriodController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\RepresentativeStoreController;

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('layouts.app');
    })->name('home');

    Route::resource('/users', UserController::class);
    Route::get('/usersDeleted', [UserController::class, 'deleted'])->name('users.deleted');
    Route::put('/users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
    Route::delete('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.forceDelete');
    Route::put('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');

    Route::resource('/roles', RoleController::class);


    // Settings page
    Route::get('/settings', [UserSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [UserSettingController::class, 'update'])->name('settings.update');
    Route::put('/settings/locale', [UserSettingController::class, 'setLocale'])->name('settings.setLocale');
    Route::put('/settings/mode', [UserSettingController::class, 'setMode'])->name('settings.setMode');
    Route::put('/settings/default', [UserSettingController::class, 'setDefault'])->name('settings.setDefault');

    // Profile page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');


    Route::resource('/warehouses', WarehouseController::class);
    Route::resource('/cities', CityController::class);
    Route::resource('/areas', AreaController::class);
    Route::resource('/specializations', SpecializationController::class);
    Route::resource('/classifications', ClassificationController::class);
    Route::resource('/doctors', DoctorController::class);
    Route::resource('/files', FileController::class);
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::get('/products/type/{type}', [ProductController::class, 'index'])->name('products.type.index');
    Route::resource('/products', ProductController::class)->except(['index']);
    Route::resource('/invoices', InvoiceController::class);
    Route::resource('/invoiceItems', InvoiceItemController::class);
    Route::get('/representativeStores/onlyshow', [RepresentativeStoreController::class, 'onlyshow'])->name('representativeStores.onlyshow');

    Route::resource('/representativeStores', RepresentativeStoreController::class);

    Route::post('/TreeProducts/store', [TreeProductController::class, 'store'])->name('TreeProducts.store');
    Route::get('/TreeProducts/upload', [TreeProductController::class, 'upload'])->name('TreeProducts.upload');
    Route::resource('/orders', OrderController::class);
    Route::put('/orders/{order}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::put('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::resource('/visitPeriods', VisitPeriodController::class);
    Route::resource('/doctorVisits', DoctorVisitController::class);
});
require __DIR__ . '/auth.php';
