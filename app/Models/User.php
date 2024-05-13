<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $guard = 'user';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_name',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role_name' => 'array',
    ];

    public function favoriteBooks()
{
    return $this->belongsToMany(Book::class, 'favorite', 'user_id', 'book_id');
}

    public function ratings()
    {
        return $this->hasMany(Rate::class);
    }
}