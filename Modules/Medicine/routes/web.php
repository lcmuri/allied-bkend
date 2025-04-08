<?php

use Illuminate\Support\Facades\Route;
use Modules\Medicine\Http\Controllers\MedicineController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicine', MedicineController::class)->names('medicine');
});
