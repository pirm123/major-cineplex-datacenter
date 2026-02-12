<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theatre extends Model
{
    use HasFactory;

    protected $fillable = [
    'branch_id',
    'theatre_number',
    'theatre_name',
    'Type_name',
    'special_format',
    'lamp_type',
    'seat_count',
    'screen_width',
    'screen_height',
    'throw_distance',

    'server_make',
    'server_model',
    'server_serial',

    'projector_make',
    'projector_model',
    'projector_serial',
    'projector_ip', // ✅ เพิ่มบรรทัดนี้

    'three_d_type',
    'initial_installation',
    'new_screen_installed_at',
    'version',
    'client_ip',

    'sound_make',
    'sound_model',
    'sound_ip',
    'sound_port',
    ];



    protected $casts = [
        'initial_installation' => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(CinemaBranch::class, 'branch_id');
    }
}
