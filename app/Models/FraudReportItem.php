<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraudReportItem extends Model
{
    use HasFactory;

    protected $table = 'FraudReportItems'; // Sesuaikan dengan nama tabel yang benar

    protected $primaryKey = 'fraud_report_item_id';

    protected $fillable = [
        'fraud_report_id', // Sesuaikan dengan field yang benar
        'serial_number',
        'cobox_id',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan model FraudReport

    public function fraudReport()
    {
        return $this->belongsTo(FraudReport::class, 'fraud_report_id');
    }
}
