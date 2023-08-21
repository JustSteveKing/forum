<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discussions', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('title');

            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('views')->default(0);

            $table
                ->foreignUlid('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            $table
                ->foreignUlid('topic_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('pinned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
