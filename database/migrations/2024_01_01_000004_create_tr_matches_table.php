<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_matches', function (Blueprint $table) {
            $table->id('id_match');
            $table->unsignedBigInteger('team_a_id');
            $table->unsignedBigInteger('team_b_id');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi', 100);
            $table->unsignedInteger('skor_tim_a')->nullable();
            $table->unsignedInteger('skor_tim_b')->nullable();
            $table->timestamps();

            $table->foreign('team_a_id')->references('id_team')->on('ms_teams')->onDelete('cascade');
            $table->foreign('team_b_id')->references('id_team')->on('ms_teams')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_matches');
    }
};
