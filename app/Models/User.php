<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'user_id';  // Make sure this matches exactly with your database column name, which seems to be `user_id` based on your logs.
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'username',
        'email',
        'Google_Id',
        'role_Id',
        'Bisnis_Unit_Id',
        'id_region',
        'password',
        'avatar',
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
        'password' => 'hashed',
    ];

    public function enroll()
    {
        return $this->hasMany(Enroll::class, 'User_Id', 'User_Id');
    }

    // Define the relationship with BisnisUnit model
    public function BisnisUnit()
    {
        return $this->belongsTo(BisnisUnit::class, 'Bisnis_Unit_Id', 'Bisnis_Unit_Id');
    }

    
}
