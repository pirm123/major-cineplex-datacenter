<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // ← เพิ่มตรงนี้
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
    'role' => 'user'
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // เพิ่ม helper role
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}

