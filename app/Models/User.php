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
        'expires_at',
        'is_active',
        'estado',
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
            'expires_at' => 'datetime',
        ];
    }

    // RELACIÓN CON COMENTARIOS
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    // VERIFICAR ROLES
    public function isJefa()
    {
        return $this->role === 'jefa';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isVisitante()
    {
        return $this->role === 'visitante';
    }

    // VERIFICAR SI HA EXPIRADO
    public function isExpired()
    {
        if ($this->expires_at) {
            return now()->greaterThan($this->expires_at);
        }
        return false;
    }

    // VERIFICAR SI ESTÁ APROBADO
    public function isAprobado()
    {
        return $this->estado === 'aprobado';
    }

    public function isPendiente()
    {
        return $this->estado === 'pendiente';
    }

    // SCOPE
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('estado', 'aprobado')
                     ->where(function($q) {
                         $q->whereNull('expires_at')
                           ->orWhere('expires_at', '>', now());
                     });
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente')->where('role', 'visitante');
    }
}