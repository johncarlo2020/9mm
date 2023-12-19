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
        Schema::create('emergency_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emergency_id');
            $table->string('image');
            $table->timestamps();

            $table->index(["emergency_id"], 'images-emergency');

            $table->foreign('emergency_id', 'images-emergency')
            ->references('id')->on('emergencies')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
