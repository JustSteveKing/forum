<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Search\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

Route::get('search', SearchController::class)->name('search');
