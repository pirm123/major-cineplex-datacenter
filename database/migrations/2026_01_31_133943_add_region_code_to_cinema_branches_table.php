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
    Schema::table('cinema_branches', function (Blueprint $table) {
        $table->string('region_code', 10)
              ->nullable()
              ->after('region');
    });
}

public function down(): void
{
    Schema::table('cinema_branches', function (Blueprint $table) {
        $table->dropColumn('region_code');
    });
}

};
