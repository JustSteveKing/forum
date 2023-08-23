<?php


declare(strict_types=1);

use App\Http\Controllers\Topics;
use Illuminate\Support\Facades\Route;

Route::get('{slug}', Topics\ShowController::class)->name('show');
