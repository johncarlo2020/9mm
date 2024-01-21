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
        Schema::create('responders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('agency_id');
            $table->timestamps();

            $table->index(["agency_id"], 'agency-responders');

            $table->foreign('agency_id', 'agency-responders')
            ->references('id')->on('agency')
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
