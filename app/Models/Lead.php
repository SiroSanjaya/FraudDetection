<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'salutation',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'kota', 
        'provinsi', 
        'address', 
        'NIK', 
        'NPWP', 
        'status', 
        'source', 
        'created_by', 
        'score', 
        'unqualifiedReason',
        'fishery_address', 
        'fishery_lat', 
        'fishery_lng', 
        'phone_valid', 
        'email_valid',
        'ktp_image'
    ];

    public function calculateScore()
    {
        $fields = [
            $this->salutation, $this->first_name, $this->last_name, $this->email,
            $this->phone_number, $this->kota, $this->provinsi, $this->address,
            $this->NIK, $this->NPWP, $this->status, $this->source, $this->fishery_address
        ];
    
        $score = 0;
    
        foreach ($fields as $field) {
            if (!is_null($field) && $field !== '') {
                $score += 4;
            }
        }
    
        if ($this->phone_valid) {
            $score += 12;
        }
    
        if ($this->email_valid) {
            $score += 12;
        }
    
        if ($this->status === 'contacted') {
            $score += 12;
        }
    
        if (!is_null($this->ktp_image) && $this->ktp_image !== '') {
            $score += 12;
        }
    
        return min($score, 100);
    }
    
    public function updateScore()
    {
        $this->score = $this->calculateScore();
        $this->save();
    }

    public function survey()
    {
        return $this->hasOne(Survey::class);
    }
}
