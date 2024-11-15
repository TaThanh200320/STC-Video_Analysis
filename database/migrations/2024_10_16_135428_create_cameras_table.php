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
        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->string('duongdan');
            $table->string('diachiip');
            $table->integer('cong');
            $table->string('tendangnhap');
            $table->string('matkhau');
            $table->enum('trangthai', ['0', '1', '2', '3'])->default('2');
            $table->foreignId('nhomid')
                ->nullable()
                ->constrained('nhom')
                ->nullOnDelete();
            $table->foreignId('vitriid')
                ->nullable()
                ->constrained('vitri')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cameras');
    }
};
