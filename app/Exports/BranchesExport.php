<?php

namespace App\Exports;

use App\Models\CinemaBranch;
use App\Models\Theatre;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BranchesExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [

            // 🟦 Sheet 1: Branches
            'Worksheet' => new class implements FromCollection, WithColumnWidths, WithEvents {
                public function collection()
                {
                   $rows = collect([
                        ['id','name','address','branch_ip','tms_ip','tms_app_ip','total_theatres','region','region_code'],
                        ['รหัสสาขา','ชื่อสาขา','ที่อยู่','IP สาขา','TMS Server (IP:PORT)','TMS APP (IP)','จำนวนโรง','ภูมิภาค','โค้ดย่อภูมิภาค'],
                    ]);

                    $data = \App\Models\CinemaBranch::select(
                        'id','name','address','branch_ip','tms_ip','tms_app_ip','total_theatres','region','region_code'
                    )->get()->toArray();

                    return $rows->merge($data);
                }

                public function columnWidths(): array
                {
                    return [
                    'A' => 8,
                    'B' => 28,
                    'C' => 45,
                    'D' => 18,
                    'E' => 22, // TMS Server
                    'F' => 18, // TMS APP
                    'G' => 18,
                    'H' => 12,
                    'I' => 14,
                    ];
                }

                public function registerEvents(): array
                {
                    return [
                        AfterSheet::class => function(AfterSheet $event) {
                            // Freeze 2 แถวแรก (หัวตาราง + คำอธิบาย)
                            $event->sheet->freezePane('A3');

                            // ทำหัวตารางเป็นตัวหนา + พื้นหลัง
                           $event->sheet->getStyle('A1:I2')->applyFromArray([
                                'font' => ['bold' => true],
                                'fill' => [
                                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                    'startColor' => ['rgb' => 'E0F2FE'], // ฟ้าอ่อน
                                ],
                                'alignment' => [
                                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                    'wrapText' => true,
                                ],
                            ]);
                        }
                    ];
                }
            },

            // 🟩 Sheet 2: Theatres
            'Worksheet 1' => new class implements FromCollection, WithColumnWidths, WithEvents {
                public function collection()
                {
                    $rows = collect([
                        ['id','branch_id','branch_name','theatre_number','seat_count','Type_name','special_format',
                         'projector_make','projector_model','projector_serial','projector_ip',
                         'server_make','server_model','server_serial','client_ip',
                         'sound_make','sound_model','sound_ip','sound_port',
                         'initial_installation','new_screen_installed_at'],
                        ['รหัสโรง','รหัสสาขา','ชื่อสาขา','เลขโรง','ที่นั่ง','ประเภท','รูปแบบพิเศษ',
                         'ยี่ห้อโปรเจคเตอร์','รุ่นโปรเจคเตอร์','Serial','IP โปรเจคเตอร์',
                         'ยี่ห้อเซิร์ฟเวอร์','รุ่นเซิร์ฟเวอร์','Serial','IP Media Block',
                         'ยี่ห้อเสียง','รุ่นเสียง','IP เสียง','Port เสียง',
                         'วันที่ติดตั้ง','วันที่เปลี่ยนจอ']
                    ]);

                    $data = \App\Models\Theatre::with('branch')->get()->map(function ($t) {
                        return [
                            $t->id,
                            $t->branch_id,
                            optional($t->branch)->name,
                            $t->theatre_number,
                            $t->seat_count,
                            $t->Type_name,
                            $t->special_format,
                            $t->projector_make,
                            $t->projector_model,
                            $t->projector_serial,
                            $t->projector_ip,
                            $t->server_make,
                            $t->server_model,
                            $t->server_serial,
                            $t->client_ip,
                            $t->sound_make,
                            $t->sound_model,
                            $t->sound_ip,
                            $t->sound_port,
                            $t->initial_installation,
                            $t->new_screen_installed_at,
                        ];
                    })->toArray();

                    return $rows->merge($data);
                }

                public function columnWidths(): array
                {
                    return [
                        'A' => 8,
                        'B' => 10,
                        'C' => 28,
                        'D' => 12,
                        'E' => 12,
                        'F' => 18,
                        'G' => 20,
                        'H' => 22,
                        'I' => 22,
                        'J' => 22,
                        'K' => 18,
                        'L' => 18,
                        'M' => 20,
                        'N' => 20,
                        'O' => 18,
                        'P' => 18,
                        'Q' => 18,
                        'R' => 18,
                        'S' => 16,
                        'T' => 16,
                        'U' => 20,
                    ];
                }

                public function registerEvents(): array
                {
                    return [
                        AfterSheet::class => function(AfterSheet $event) {
                            $event->sheet->freezePane('A3');

                            $event->sheet->getStyle('A1:U2')->applyFromArray([
                                'font' => ['bold' => true],
                                'fill' => [
                                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                    'startColor' => ['rgb' => 'ECFEFF'], // เขียวอ่อน
                                ],
                                'alignment' => [
                                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                    'wrapText' => true,
                                ],
                            ]);
                        }
                    ];
                }
            },
        ];
    }
}