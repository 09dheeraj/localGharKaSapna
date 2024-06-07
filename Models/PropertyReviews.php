<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyReviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'vendor_id',
        'property_id',
        'rating',
        'comment',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
