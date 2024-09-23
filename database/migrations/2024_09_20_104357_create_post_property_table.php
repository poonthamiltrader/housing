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
        Schema::create('post_property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertytype_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('grandparent_id')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('area_id');
            $table->text('address1')->nullable();
            $table->bigInteger('exepected_price')->nullable();
            $table->bigInteger('exepected_rent')->nullable();
            $table->bigInteger('extra_charges')->nullable();
            $table->bigInteger('deposit_value')->nullable();
            $table->string('agreement_duration')->nullable();
            $table->string('months_notice')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('area_id')->references('id')->on('area');
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('propertytype_id')->references('id')->on('property_types');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_property');
    }
};
