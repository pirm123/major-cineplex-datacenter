<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Theatre;

class CinemaBranch extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'address',
    'tms_ip',
    'branch_ip',
    'total_theatres',
    'region',
    'zone', // ถ้ายังไม่ใช้ ปล่อยไว้ได้
];



    public function theatres()
    {
        return $this->hasMany(Theatre::class, 'branch_id');
    }
}
