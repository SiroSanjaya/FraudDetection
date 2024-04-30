<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments'; // jika nama tabel tidak sesuai konvensi Laravel
    protected $primaryKey = 'shipment_id';
    public $timestamps = false;
    protected $fillable = [
        'order_id', 'user_id', 'point_id', 'shipment_date', 'expected_arrival', 'status', 'shipment_address'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function point()
    {
        return $this->belongsTo('App\Models\Point', 'point_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

}
