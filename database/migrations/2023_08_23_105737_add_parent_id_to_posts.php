<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', static function (Blueprint $table): void {
            $table->after(
                column: 'discussion_id',
                callback: fn (Blueprint $table) => $table
                    ->foreignUlid('parent_id')
                    ->nullable()
                    ->index()
                    ->constrained('posts')
                    ->nullOnDelete()
                ,
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', static function (Blueprint $table): void {
            $table->dropColumn('parent_id');
        });
    }
};
