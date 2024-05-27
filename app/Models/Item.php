<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';  // Assuming this is the primary key of your table
    protected $table = 'items';  // Make sure this matches exactly with your database table name

    protected $fillable = [
        'product_id',  // Assuming you have more fields like 'name', 'description', etc.
        'item_serial_number',
        'is_available',
        'cobox_name',
        'cobox_id'
    ];

    /**
     * Get the product that owns the item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class, 'order_item_products', 'product_id', 'order_item_id');
    }

    // Additional methods and relationships can be added here
}
