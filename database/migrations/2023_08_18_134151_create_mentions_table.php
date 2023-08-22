<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('mentions', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table
                ->foreignUlid('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignUlid('post_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->index(['user_id','post_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentions');
    }
};
