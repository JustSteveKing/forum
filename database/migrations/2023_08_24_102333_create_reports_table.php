<?php

use App\Enums\Moderation\Outcome;
use App\Enums\Moderation\Reason;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('reason')->default(Reason::OTHER->value); // Why
            $table->string('outcome')->default(Outcome::INVESTIGATION->value);

            $table->text('content'); // What

            $table->ulidMorphs('reportable'); // What content

            $table->boolean('anonymous')->default(true);

            $table
                ->foreignUlid('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(['user_id', 'reportable_id', 'reportable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
