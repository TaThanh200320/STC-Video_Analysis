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
        Schema::create('nhom', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'ten');
            $table->string('mota')->nullable();
            $table->enum('loainhom', ['khuvuc', 'chucnang']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhom');
    }
};