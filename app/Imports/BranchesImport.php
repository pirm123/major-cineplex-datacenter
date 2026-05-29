<?php

namespace App\Imports;

use App\Models\CinemaBranch;
use App\Models\Theatre;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;

class BranchesImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [

            // ================= Sheet 1 : Branches =================
            'Worksheet' => new class implements ToCollection {

                public function collection(Collection $rows)
                {
                    DB::transaction(function () use ($rows) {

                        $excelKeys = [];

                        foreach ($rows as $i => $row) {
                            if ($i < 2) continue; // ข้าม header 2 แถว

                            $name     = trim((string) ($row[1] ?? ''));
                            $branchIp = trim((string) ($row[3] ?? ''));

                            if ($name === '' && $branchIp === '') continue;

                            $key = $branchIp !== '' ? ['branch_ip' => $branchIp] : ['name' => $name];
                            $excelKeys[] = $branchIp !== '' ? $branchIp : $name;

                            $data = [
                                'name'           => $name,
                                'address'        => trim((string) ($row[2] ?? '')),
                                'branch_ip'      => $branchIp !== '' ? $branchIp : null,

                                // ของเดิม
                                'tms_ip'         => trim((string) ($row[4] ?? '')),

                                // ✅ เพิ่มใหม่: TMS APP IP
                                'tms_app_ip'     => trim((string) ($row[5] ?? '')),

                                'total_theatres' => (int) ($row[6] ?? 0),
                                'region'         => trim((string) ($row[7] ?? '')),
                                'region_code'    => trim((string) ($row[8] ?? '')),
                            ];

                            CinemaBranch::updateOrCreate($key, $data);
                        }

                        if (!empty($excelKeys)) {
                            CinemaBranch::whereNotIn('branch_ip', $excelKeys)
                                ->whereNotIn('name', $excelKeys)
                                ->delete();
                        }
                    });
                }
            },

            // ================= Sheet 2 : Theatres =================
            'Worksheet 1' => new class implements ToCollection {

                public function collection(Collection $rows)
                {
                    DB::transaction(function () use ($rows) {

                        $excelIds = [];

                        foreach ($rows as $i => $row) {
                            if ($i < 2) continue;

                            $rawId = $row[0] ?? null;
                            $id = is_null($rawId) ? null : (int) trim((string) $rawId);
                            if (!$id) continue;

                            $excelIds[] = $id;

                            $data = [
                                'branch_id'             => $row[1] ?? null,
                                'theatre_number'       => $row[3] ?? null,
                                'seat_count'           => (int) ($row[4] ?? 0),
                                'Type_name'            => $row[5] ?? null,
                                'special_format'       => $row[6] ?? null,

                                'projector_make'       => $row[7] ?? null,
                                'projector_model'      => $row[8] ?? null,
                                'projector_serial'     => $row[9] ?? null,
                                'projector_ip'         => $row[10] ?? null,

                                'server_make'          => $row[11] ?? null,
                                'server_model'         => $row[12] ?? null,
                                'server_serial'        => $row[13] ?? null,
                                'client_ip'            => $row[14] ?? null,

                                'sound_make'           => $row[15] ?? null,
                                'sound_model'          => $row[16] ?? null,
                                'sound_ip'             => $row[17] ?? null,
                                'sound_port'           => $row[18] ?? null,

                                'initial_installation'     => $row[19] ?? null,
                                'new_screen_installed_at'  => $row[20] ?? null,
                            ];

                            Theatre::updateOrCreate(['id' => $id], $data);
                        }

                        if (!empty($excelIds)) {
                            Theatre::whereNotIn('id', $excelIds)->delete();
                        }
                    });
                }
            },

        ];
    }
}