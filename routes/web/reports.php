<?php

declare(strict_types=1);

use App\Http\Controllers\Reports;
use Illuminate\Support\Facades\Route;

Route::get('{ulid}/{reportable}', Reports\CreateController::class)->name('create');
Route::post('/', Reports\StoreController::class)->name('store');
