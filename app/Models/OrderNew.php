<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderNew extends Model
{
    protected $table = 'order_new';
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'order_date', 'total_amount', 'customer_id', 'point_id', 'qty', 'status'
    ];

    public function items()
    {
        return $this->hasMany(ItemNew::class, 'order_id', 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id', 'point_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
