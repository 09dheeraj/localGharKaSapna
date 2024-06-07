<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticles extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'heading',
        'excerpt',
        'comments',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'short_description',
        'content',
        'featured_image',
        'additional_images',
        'status',
    ];

    public function cat(){
        return $this->belongsTo(ArticleCategories::class, 'category', 'id');
    }
}
