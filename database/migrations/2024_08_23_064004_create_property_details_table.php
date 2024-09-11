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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->Integer('no_of_bedrooms');
            $table->Integer('no_of_bathrooms');
            $table->Integer('balconies');
            $table->unsignedBigInteger('carpet_area_sq') ->nullable();;
            $table->unsignedBigInteger('builtup_area_sq')->nullable();;
            $table->unsignedBigInteger('super_builtup_area_sq')->nullable();;
            $table->tinyInteger('is_poojaroom')->default(0);
            $table->tinyInteger('is_studyroom')->default(0);
            $table->tinyInteger('is_serventroom')->default(0);
            $table->tinyInteger('is_storeroom')->default(0);
            $table->tinyInteger('is_furnished')->default(0);
            $table->tinyInteger('is_semifurnished')->default(0);
            $table->tinyInteger('is_unfurnished')->default(0);
            $table->Integer('covered_parking');
            $table->Integer('open_parking');
            $table->Integer('total_floors');
            $table->Integer('property_on_floors');
            $table->tinyInteger('is_ready_to_move')->default(0);
            $table->tinyInteger('is_under_construction')->default(0);
            $table->unsignedBigInteger('age_property');
            $table->text('video_url')->nullable(); 
            $table->text('images')->nullable();
            $table->unsignedBigInteger('expected_price');
            $table->unsignedBigInteger('price_per_sqt');
            $table->tinyInteger('charge_brokerage')->default(0);
            $table->unsignedBigInteger('brokerage_amount');
            $table->string('description');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            
            $table->foreign('property_id')->references('id')->on('property')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_details');
    }
};
