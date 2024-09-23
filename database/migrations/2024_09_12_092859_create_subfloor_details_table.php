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
        Schema::create('subfloor_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertytype_id');
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('project_id');
            $table->bigInteger('price');
            $table->bigInteger('builtup_area');

            $table->timestamps();
            $table->foreign('propertytype_id')->references('id')->on('property_types');
            $table->foreign('floor_id')->references('id')->on('floor_details');
            $table->foreign('project_id')->references('id')->on('project_details');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subfloor_details');
    }
};
