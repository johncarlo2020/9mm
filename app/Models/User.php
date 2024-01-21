<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'fcm_token',
        'password',
    ];

    protected $appends = ['role','agency'];

    public function getAgencyAttribute()
    {
        return $this->agent()->first()->agency_id ?? '';

    }


    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

    public function emergency()
    {
        return $this->hasMany(Emergency::class);
    }

    public function getRoleAttribute()
    {
        // Assuming a user has only one role, you can adjust this logic based on your requirements
        $role = $this->roles->first();

        return $role ? $role->name : null;
    }
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
}
