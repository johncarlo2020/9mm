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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agency_id');

            $table->timestamps();

            $table->index(["user_id"], 'user-agency');
            $table->index(["agency_id"], 'agency-user');


            $table->foreign('user_id', 'user-agency')
            ->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->foreign('agency_id', 'agency-user')
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
