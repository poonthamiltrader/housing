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
        Schema::create('postproperty_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postproperty_id');
            $table->text('video_url')->nullable(); 
            $table->text('images_path')->nullable();
            $table->timestamps();

            $table->foreign('postproperty_id')->references('id')->on('post_property');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postproperty_images');
    }
};
