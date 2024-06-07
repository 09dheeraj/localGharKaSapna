<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_id',
        'property_name',
        'property_type',
        'looking_to',
        'categories',
        'city',
        'project_society',
        'locality',
        'price',
        'security_deposity',
        'area_unit',
        'built_up_area',
        'carpet_area',
        'plot_area',
        'width',
        'height',
        'total_property',
        'your_floor',
        'bath',
        'balconies',
        'property_age',
        'possession_status',
        'property_condition',
        'possession_date',
        'zone_type',
        'location_hub',
        'located_near',
        'ownership',
        'staircase',
        'passenger_lift',
        'service_lift',
        'private_parking',
        'public_parking',
        'private_washroom',
        'public_washroom',
        'conference_room',
        'min_seat',
        'max_seat',
        'cabins',
        'meeting_room',
        'room_type',
        'bed_in_room',
        'bathroom_style',
        'pg_for',
        'suited_for',
        'meal',
        'meal_offering',
        'meal_speciality',
        'meal_charges',
        'electricity_charges',
        'notice_period',
        'lock_in_period',
        'manager_stay',
        'non_veg',
        'opposite_sex',
        'any_time',
        'visitors',
        'guardian',
        'drink_smok',
        'negotiable',
        'dg_ups',
        'electricity_charge',
        'water_charge',
        'tax_govt',
        'furnish_type',
        'amenities',
        'images',
        'video',
        'status',
    ];

    public function owner(){

        return $this->belongsTo(User::class, 'reg_id', 'id');
        
    }
    
}
