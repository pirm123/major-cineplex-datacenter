<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('theatres', function (Blueprint $table) {
            if (Schema::hasColumn('theatres', 'backup_35mm')) {
                $table->dropColumn('backup_35mm');
            }
        });
    }

    public function down()
    {
        Schema::table('theatres', function (Blueprint $table) {
            $table->string('backup_35mm')->nullable();
        });
    }
};
