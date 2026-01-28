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
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Métodos de verificação de role
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAnalista(): bool
    {
        return $this->role === 'analista';
    }

    public function releases()
    {
        return $this->hasMany(Release::class);
    }
}