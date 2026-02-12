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
      Schema::table('theatres', function (Blueprint $table) {
      $table->string('projector_ip')->nullable()->after('client_ip');
    });
   }

    public function down()
   {
     Schema::table('theatres', function (Blueprint $table) {
     $table->dropColumn('projector_ip');
    });
   }

};
