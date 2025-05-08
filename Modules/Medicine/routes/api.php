<?php

use Illuminate\Support\Facades\Route;
use Modules\Medicine\Http\Controllers\CategoryController;
use Modules\Medicine\Http\Controllers\MedicineController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('medicine', MedicineController::class)->names('medicine');
// });

Route::prefix('v1')->group(function () {
    Route::apiResource('category', CategoryController::class)->names('category');
});
