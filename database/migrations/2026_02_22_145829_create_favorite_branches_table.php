<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('favorite_branches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('cinema_branch_id')->constrained()->cascadeOnDelete();
        $table->timestamps();

        $table->unique(['user_id', 'cinema_branch_id']); // ห้ามซ้ำ
    });
}
};
