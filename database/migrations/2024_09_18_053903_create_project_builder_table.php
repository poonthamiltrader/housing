
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
        Schema::create('project_builder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('builder_id');
            $table->unsignedBigInteger('project_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('builder_id')->references('id')->on('builder');
            $table->foreign('project_id')->references('id')->on('project_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_builder');
    }
};
