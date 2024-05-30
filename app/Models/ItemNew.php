<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemNew extends Model
{
    protected $table = 'item_new';
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'order_id', 'product_id', 'item_serial_number', 'is_available', 'cobox_name', 'cobox_id'
    ];

    public function order()
    {
        return $this->belongsTo(OrderNew::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $item->updateProductStock();
        });

        static::updated(function ($item) {
            $item->updateProductStock();
        });

        static::deleted(function ($item) {
            $item->updateProductStock();
        });
    }

    public function updateProductStock()
    {
        $product = $this->product;
        if ($product) {
            $product->stock = $product->itemsNew()->where('is_available', true)->count();
            $product->save();
        }
    }
}
