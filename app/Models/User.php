<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nik',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $attributes = [
        'role' => 'user',
        'disabled' => 'false'
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    
    public function blacklist(): HasOne
    {
        return $this->hasOne(Blacklist::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function suggestion()
    {
        return $this->hasMany(Suggestion::class);
    }

    public function entrance()
    {
        return $this->hasMany(Entrance::class);
    }
}
