<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('cinema_branches', function (Blueprint $table) {
        $table->string('region')->default('อื่น ๆ')->after('name');
    });
}


public function down()
{
    Schema::table('cinema_branches', function (Blueprint $table) {
        $table->dropColumn('region');
    });
}

};
