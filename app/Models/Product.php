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
    public function items()
    {
        return $this->hasMany(Item::class, 'product_id');
    }

    // Additional methods and relationships can be added here
}
