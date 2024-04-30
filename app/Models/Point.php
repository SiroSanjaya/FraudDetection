<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $primaryKey = 'point_id';

    protected $table = 'points';  // Pastikan ini sesuai dengan nama tabel yang sebenarnya di database Anda

    protected $fillable = [
        'point_name'  // Sesuaikan ini dengan kolom yang ada di tabel points
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'point_id', 'point_id');
    }
}
