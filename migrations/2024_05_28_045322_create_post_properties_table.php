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
        Schema::create('post_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reg_id')->nullable();
            $table->string('property_name');
            $table->enum('property_type', ['residential', 'commercial'])->nullable();
            $table->enum('looking_to', ['pg', 'rent', 'sell'])->nullable();
            $table->string('categories')->nullable();
            $table->string('city')->nullable();
            $table->text('project_society')->nullable();
            $table->text('locality')->nullable();
            $table->string('price')->nullable();
            $table->string('security_deposity')->nullable();
            $table->string('area_unit')->nullable();
            $table->string('built_up_area')->nullable();
            $table->string('carpet_area')->nullable();
            $table->string('plot_area')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('total_property')->nullable();
            $table->string('your_floor')->nullable();
            $table->string('bath')->nullable();
            $table->string('balconies')->nullable();
            $table->string('property_age')->nullable();
            $table->string('possession_status')->nullable();
            $table->string('property_condition')->nullable();
            $table->string('possession_date')->nullable();
            $table->string('zone_type')->nullable();
            $table->string('location_hub')->nullable();
            $table->string('located_near')->nullable();
            $table->string('ownership')->nullable();
            $table->string('staircase')->nullable();
            $table->string('passenger_lift')->nullable();
            $table->string('service_lift')->nullable();
            $table->string('private_parking')->nullable();
            $table->string('public_parking')->nullable();
            $table->string('private_washroom')->nullable();
            $table->string('public_washroom')->nullable();
            $table->string('conference_room')->nullable();
            $table->string('min_seat')->nullable();
            $table->string('max_seat')->nullable();
            $table->string('cabins')->nullable();
            $table->string('meeting_room')->nullable();
            $table->string('room_type')->nullable();
            $table->string('bed_in_room')->nullable();
            $table->string('bathroom_style')->nullable();
            $table->string('pg_for');
            $table->string('suited_for');
            $table->string('meal');
            $table->string('meal_offering');
            $table->string('meal_speciality');
            $table->string('meal_charges');
            $table->string('electricity_charges');
            $table->string('notice_period');
            $table->string('lock_in_period');
            $table->string('manager_stay');
            // radio butond Data
            $table->string('non_veg');
            $table->string('opposite_sex');
            $table->string('any_time');
            $table->string('visitors');
            $table->string('guardian');
            $table->string('drink_smok');
            $table->string('negotiable');
            $table->string('dg_ups');
            $table->string('electricity_charge');
            $table->string('water_charge');
            $table->string('tax_govt');
            $table->string('furnish_type');
            $table->text('amenities');
            $table->text('images');
            $table->text('video');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_properties');
    }
};
