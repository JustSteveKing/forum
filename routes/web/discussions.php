<?php

declare(strict_types=1);

use App\Http\Controllers\Discussions;
use App\Http\Controllers\Posts;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(static function (): void {
    Route::post('/', Discussions\StoreController::class)->name('store');

    Route::prefix('{discussion:id}/posts')->as('posts:')->group(static function (): void {
        Route::post('/', Posts\StoreController::class)->name('store');
    });
});

Route::get('{ulid}', Discussions\ShowController::class)->name('show');


