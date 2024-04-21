<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'role';
     protected $primaryKey = 'role_Id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'role_name',
    ];
}
