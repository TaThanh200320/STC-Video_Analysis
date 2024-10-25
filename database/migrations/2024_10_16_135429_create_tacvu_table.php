<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tacvu', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('mota')->nullable();
            $table->json('cauhinh');
            $table->timestamps();
        });

        Schema::create('tacvucuarcamera', function (Blueprint $table) {
            $table->json('cauhinh');
            $table->foreignId('cameraid')
                ->nullable()
                ->constrained('cameras')
                ->cascadeOnDelete();
            $table->foreignId('tacvuid')
                ->nullable()
                ->constrained('tacvu')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tacvu');
    }
};
