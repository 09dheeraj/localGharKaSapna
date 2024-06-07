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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID of the user who wrote the review');
            $table->unsignedBigInteger('vendor_id')->nullable()->comment('ID of the vendor being reviewed');
            $table->unsignedBigInteger('property_id')->nullable()->comment('ID of the property being reviewed');
            $table->integer('rating')->nullable()->comment('Rating given by the user');
            $table->text('comment')->nullable()->comment('Text of the review');
            $table->string('status')->nullable()->comment('Status of the review (e.g., approved, pending)');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('post_properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
