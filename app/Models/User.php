<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'profile_picture',
        'whatsapp_number',
        'website',
        'user_type', // Adicione o campo user_type aqui
    ];

    /**
     * Atributos ocultos para arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversões de tipos para os atributos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Utilizado para hashing automático do Laravel 9+
    ];
}
