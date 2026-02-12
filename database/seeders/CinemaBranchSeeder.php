<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CinemaBranch;

class CinemaBranchSeeder extends Seeder
{
    public function run(): void
    {
        CinemaBranch::updateOrCreate(
            [ 'name' => 'Major Cineplex Ratchayothin' ],
            [
                'address'        => 'รัชโยธิน กรุงเทพฯ',
                'total_theatres' => 15,
                'branch_ip'      => '10.131.10.247',
                'updated_at'     => now(),
                'created_at'     => now()
            ]
        );

        CinemaBranch::updateOrCreate(
            [ 'name' => 'Paragon Cineplex' ],
            [
                'address'        => 'สยามพารากอน กรุงเทพฯ',
                'total_theatres' => 15,
                'branch_ip'      => '10.131.1.247',
                'updated_at'     => now(),
                'created_at'     => now()
            ]
        );
    }
}
