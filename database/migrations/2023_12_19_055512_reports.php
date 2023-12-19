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
        Schema::create('emergencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('location');

            $table->timestamps();

            $table->index(["user_id"], 'user-reports');
            $table->index(["agency_id"], 'reports-user');


            $table->foreign('user_id', 'reports-agency')
            ->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->foreign('agency_id', 'agency-reports')
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
