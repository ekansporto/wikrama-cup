<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ms_players', function (Blueprint $table) {
            $table->string('gender', 20)->default('Boys')->after('posisi');
        });
    }

    public function down(): void
    {
        Schema::table('ms_players', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
};
