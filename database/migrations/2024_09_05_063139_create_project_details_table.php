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
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('address')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('area_id');
            $table->integer('building_status');
            $table->date('completion_date');
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('floor_id');
            $table->longText('project_description')->nullable();
            $table->unsignedBigInteger('builder_id');
            $table->unsignedBigInteger('amenities_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('state');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('area_id')->references('id')->on('area');
            $table->foreign('builder_id')->references('id')->on('builder');
            $table->foreign('floor_id')->references('id')->on('subfloor_details');
            $table->foreign('amenities_id')->references('id')->on('project_amenities');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
