<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraudReport extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model
    protected $table = 'FraudReports';
    protected $primaryKey = 'report_report_id';

    // Tentukan kolom-kolom yang bisa diisi (mass assignable attributes)
    protected $fillable = [
        'order_id',
        'user_id',
        'customer_name',
        'cobox_id',
        'serial_number',
        'location_map',
        'status',
        'photo_path'
    ];

    /**
     * Mendefinisikan relasi ke model Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
