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
        Schema::create('emergency_responders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('responder_id');
        $table->unsignedBigInteger('emergency_id');

        $table->index(["responder_id"], 'emergency-responders');
        $table->index(["emergency_id"], 'responders-emergency');


        $table->foreign('responder_id', 'emergency-responders')
            ->references('id')->on('responders')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            
        $table->foreign('emergency_id', 'responders-emergency')
            ->references('id')->on('emergencies')
            ->onDelete('restrict')
            ->onUpdate('restrict');


        $table->timestamps();
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
