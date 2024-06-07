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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('role')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'image', 'description', 'city', 'address', 'role', 'status']);

        });
    }
};
