<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraudReport extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model
    protected $table = 'FraudReports';
    protected $primaryKey = 'fraud_report_id';

    // Tentukan kolom-kolom yang bisa diisi (mass assignable attributes)
    protected $fillable = [
        'order_id',
        'user_id',
        'customer_name',
        'cobox_id',
        'serial_number',
        'location_map',
        'status',
        'point_name',
        'photo_path'
    ];

    /**
     * Mendefinisikan relasi ke model Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function fraudReportItems()
    {
        return $this->hasMany(FraudReportItem::class, 'fraud_report_id', 'fraud_report_id');
    }
}
