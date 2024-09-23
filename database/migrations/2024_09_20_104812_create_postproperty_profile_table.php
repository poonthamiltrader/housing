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
        Schema::create('postproperty_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postproperty_id');
            $table->Integer('no_bedrooms')->nullable();
            $table->Integer('no_bathrooms')->nullable();
            $table->Integer('balconies')->nullable();
            $table->bigInteger('carpet_area_sq')->nullable();
            $table->bigInteger('builtup_area_sq')->nullable();
            $table->bigInteger('plot_area_sq')->nullable();
            $table->tinyInteger('is_parking')->default(0)->nullable();
            $table->tinyInteger('is_furnishing')->default(0)->nullable();
            $table->Integer('total_floor')->nullable();
            $table->string('property_onfloor')->nullable();
            $table->integer('availablity_status')->default(1)->nullable();
            $table->integer('age_ofproperty')->default(1)->nullable();
            $table->string('possession')->default(1)->nullable();
            $table->integer('apartment_type')->nullable();
            $table->timestamps();

            $table->foreign('postproperty_id')->references('id')->on('post_property');




           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postproperty_profile');
    }
};
