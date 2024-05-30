<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';  // Assuming this is the primary key of your table
    protected $table = 'products';  // Make sure this matches exactly with your database table name
    protected $fillable = [
        'name', 'description', 'price', 'stock'  // Assuming these are the fields you need.
    ];

    /**
     * Get the items associated with the product.
     */
    public function itemsNew()
    {
        return $this->hasMany(ItemNew::class, 'product_id', 'product_id');
    }

    public function getStockAttribute()
    {
        return $this->itemsNew()->where('is_available', true)->count();
    }

    // Additional methods and relationships can be added here
}
