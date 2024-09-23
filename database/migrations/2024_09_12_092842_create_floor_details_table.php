<?php

use App\Models\Propertytypes;
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
        Schema::create('floor_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertytype_id');
            $table->unsignedBigInteger('project_id');
            $table->bigInteger('from_price');
            $table->bigInteger('to_price');
            $table->bigInteger('from_sqft');
            $table->bigInteger('to_sqft');
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
            $table->foreign('propertytype_id')->references('id')->on('property_types');
            $table->foreign('project_id')->references('id')->on('project_details');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floor_details');
    }
};
