<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theatres', function (Blueprint $table) {
            $table->string('sound_make')->nullable()->after('projector_serial');
            $table->string('sound_model')->nullable()->after('sound_make');
            $table->string('sound_ip')->nullable()->after('sound_model');
            $table->string('sound_port')->nullable()->after('sound_ip');
        });
    }

    public function down(): void
    {
        Schema::table('theatres', function (Blueprint $table) {
            $table->dropColumn(['sound_make', 'sound_model', 'sound_ip', 'sound_port']);
        });
    }
};
