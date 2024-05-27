<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = false;  // Set this to false as order_id is a string
    public $timestamps = false;
    public $keyType = 'string';    // Explicitly tell Eloquent that the key type is a string
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'order_id',  // Make sure to include order_id if you're using it in fillable
        'user_id',
        'order_date',
        'total_amount',
        'status',
        'customer_id',
        'point_id',
        'updated_at',
        'created_at'
    ];

    // Relationship to Point
    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id', 'point_id');
    }

    // Relationship to Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // Relationship to OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    // Attribute for total quantity
    public function getTotalQuantityAttribute()
    {
        return $this->orderItems->sum('quantity');
    }

    // Attribute for the first cobox name
    public function getFirstCoboxNameAttribute()
    {
        return $this->orderItems->first()->cobox_name ?? 'No cobox';
    }

    // Relationship to Users (Salesperson)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // 'user_id' is the foreign key in orders table pointing to users
    }

    // Relationship to Shipment
    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_id', 'order_id');
    }

    // Relationship to FraudReport
    public function fraudReport()
    {
        return $this->hasOne(FraudReport::class, 'order_id', 'order_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'product_id', 'product_id');
    }
}
