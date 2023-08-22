<?php

declare(strict_types=1);

use App\Http\Controllers\Discussions;
use App\Http\Controllers\Posts;
use Illuminate\Support\Facades\Route;

Route::post('/', Discussions\StoreController::class)->name('store');
Route::get('{ulid}', Discussions\ShowController::class)->name('show');

Route::prefix('{discussion:id}/posts')->as('posts:')->group(static function (): void {
    ROute::post('/', Posts\StoreController::class)->name('store');
});
