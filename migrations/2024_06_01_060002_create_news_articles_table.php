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
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Article title');
            $table->string('heading')->comment('Article heading'); 
            $table->text('excerpt')->comment('Short summary or tick description'); 
            $table->text('comments')->nullable()->comment('Comments on the article'); 
            $table->string('meta_title')->comment('Meta title for SEO'); 
            $table->string('meta_description')->comment('Meta description for SEO'); 
            $table->string('meta_keywords')->comment('Meta keywords for SEO'); 
            $table->text('short_description')->comment('Short description of the article');
            $table->longText('content')->comment('Full content of the article'); 
            $table->string('featured_image')->nullable()->comment('URL to the featured image'); 
            $table->string('additional_images')->nullable()->comment('URL to other images'); 
            $table->enum('status', ['pending', 'published'])->default('pending')->comment('Status of the article'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
