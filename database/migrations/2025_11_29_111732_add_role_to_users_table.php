<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {

        // 🔥 ตรวจสอบก่อนว่ามีคอลัมน์ role อยู่แล้วหรือยัง
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('user')->after('email');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        // ลบได้เฉพาะตอนที่คอลัมน์ยังมีอยู่
        if (Schema::hasColumn('users', 'role')) {
            $table->dropColumn('role');
        }
    });
}

};
