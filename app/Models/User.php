<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
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
        'password',
        'role_id'
        
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
    ];


    //to automatically indicate date and time once user account is created
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->email_verified_at = Carbon::now();
        });
    }

    //many to 1
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //1 to many
    public function expenses(): HasMany
    {
        return $this->hasMany(Expenses::class);
    }
}
