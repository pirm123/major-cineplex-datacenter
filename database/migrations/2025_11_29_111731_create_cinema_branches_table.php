<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cinema_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // 🟢 ชื่อสาขา
            $table->string('address')->nullable();   // ที่อยู่ (ถ้ามี)
            $table->unsignedTinyInteger('total_theatres')->default(0); // จำนวนโรง
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cinema_branches');
    }
};
