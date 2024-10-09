<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(255);
            $table->string('slug')->length(255);
            $table->integer('groupby');
            $table->timestamps();
        });

        DB::table('permission')->insert([
            ['name' => 'Dashboard', 'slug' => 'dashboard', 'groupby' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Config', 'slug' => 'config', 'groupby' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add Config', 'slug' => 'add-config', 'groupby' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit Config', 'slug' => 'edit-config', 'groupby' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Config', 'slug' => 'delete-config', 'groupby' => 1, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Alarm', 'slug' => 'alarm', 'groupby' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add Alarm', 'slug' => 'add-alarm', 'groupby' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit Alarm', 'slug' => 'edit-alarm', 'groupby' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Alarm', 'slug' => 'delete-alarm', 'groupby' => 2, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Events', 'slug' => 'event', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add Events', 'slug' => 'add-event', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit Events', 'slug' => 'edit-event', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Events', 'slug' => 'delete-event', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Events', 'slug' => 'events', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add Events', 'slug' => 'add-events', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit Events', 'slug' => 'edit-events', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Events', 'slug' => 'delete-events', 'groupby' => 3, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Video Analysis', 'slug' => 'video-analysis', 'groupby' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add Video Analysis', 'slug' => 'add-video-analysis', 'groupby' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit Video Analysis', 'slug' => 'edit-video-analysis', 'groupby' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Video Analysis', 'slug' => 'delete-video-analysis', 'groupby' => 4, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'User', 'slug' => 'user', 'groupby' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add User', 'slug' => 'add-user', 'groupby' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit User', 'slug' => 'edit-user', 'groupby' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete User', 'slug' => 'delete-user', 'groupby' => 5, 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Role', 'slug' => 'role', 'groupby' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Add Role', 'slug' => 'add-role', 'groupby' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Edit Role', 'slug' => 'edit-role', 'groupby' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Role', 'slug' => 'delete-role', 'groupby' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission');
    }
};