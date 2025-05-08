<?php

use Illuminate\Support\Facades\Route;
use Modules\Medicine\Http\Controllers\CategoryController;
use Modules\Medicine\Http\Controllers\MedicineController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('medicines', MedicineController::class)->names('medicine');
// });

Route::prefix('v1')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::apiResource('', CategoryController::class)->names('category');
        Route::get('roots', [CategoryController::class, 'roots']);
        Route::get('{id}/children', [CategoryController::class, 'withChildren']);
        Route::get('{id}/descendants', [CategoryController::class, 'withDescendants']);
        Route::get('parent_categories', [CategoryController::class, 'parent_categories'])->name('category.parent_categories');
    });
});
