<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'name', 'email', 'phone', 'assigned_to', 'company_name', 'street',
        'city', 'state', 'zip_code', 'country', 'date_of_birth',
        'customer_since', 'last_purchase_date', 'total_spent', 'loyalty_tier', 'notes', 'farm_type'
    ];

    // Define relationships
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'user_id');
    }

    // Additional relationships can be added here
}
