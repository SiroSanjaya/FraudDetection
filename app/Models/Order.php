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
        'order_date' => 'datetime',
        'total_amount',
        'status',
        'customer_id',
        'point_id',
    ];

     // Relasi ke Point
     public function point()
     {
         return $this->belongsTo(Point::class, 'point_id', 'point_id');
     }

     // Relasi ke Customer
     public function customer()
     {
         return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
     }
     public function items()
{
    return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
}


public function getTotalQuantityAttribute()
{
    return $this->items->sum('quantity');
}
public function getFirstCoboxNameAttribute()
{
    return $this->items->first()->cobox_name ?? 'No cobox';
}

public function show($orderId)
{
    $order = Order::with(['customer', 'items'])->findOrFail($orderId);
    return view('admin.CrudDelivey.DataOrder', compact('order'));
}

// Dalam model Order
public function users()
{
    return $this->belongsToMany(User::class,  'order_id', 'user_id');
}

// Di dalam class Order

public function shipment()
{
    return $this->hasOne(Shipment::class, 'order_id', 'order_id');
    // Jika kunci asing di tabel shipment adalah 'order_id' dan primary key di Order juga 'order_id'
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');  // 'user_id' adalah foreign key di tabel orders yang mengarah ke users
}


}




