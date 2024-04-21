<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'region';
     protected $primaryKey = 'id_region';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'region_name',
    ];
}
