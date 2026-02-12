<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theatres', function (Blueprint $table) {
            $table->id();

            // FK ไปยังสาขาโรงหนัง
            $table->foreignId('branch_id')
                  ->constrained('cinema_branches')
                  ->onDelete('cascade');

            // ...

            // ข้อมูลโรง
            $table->unsignedTinyInteger('theatre_number');       // เลขโรง 1-15
            $table->string('theatre_name')->nullable();          // ชื่อเรียกโรง (ถ้ามี)
            $table->string('Type_name')->nullable();           // Laser / Laser RGB ฯลฯ
            $table->string('special_format')->nullable();        // ATMOS / IMAX / Kids ฯลฯ
            $table->string('lamp_type')->nullable();             // Laser / Lamp type
            $table->unsignedSmallInteger('seat_count')->nullable(); // จำนวนที่นั่ง

            // ✅ ขนาดจอ + ระยะฉาย
            $table->decimal('screen_width', 5, 2)->nullable();   // Screen Wide (เมตร)
            $table->decimal('screen_height', 5, 2)->nullable();  // Screen Height (เมตร)
            $table->decimal('throw_distance', 5, 2)->nullable(); // Throw Distance (เมตร)

            // Server (Media Block)
            $table->string('server_make')->nullable();
            $table->string('server_model')->nullable();
            $table->string('server_serial')->nullable();

            // Projector
            $table->string('projector_make')->nullable();
            $table->string('projector_model')->nullable();
            $table->string('projector_serial')->nullable();

            // อื่น ๆ
            $table->string('three_d_type')->nullable();          // RealD / IMAX 3D ฯลฯ
            $table->string('backup_35mm')->nullable();           // Y / N
            $table->date('initial_installation')->nullable();    // วันที่ติดตั้งเดิม

            // ✅ วันที่เปลี่ยนจอใหม่ตามคอลัมน์ "New Screen Installed D-M-Y"
            $table->date('new_screen_installed_at')->nullable();

            $table->string('version')->nullable();               // เวอร์ชัน SW
            $table->string('client_ip', 45)->nullable();                     // IP เครื่อง

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theatres');
    }
};
