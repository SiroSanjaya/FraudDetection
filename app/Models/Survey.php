<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['lead_id', 'description'];

    public function images()
    {
        return $this->hasMany(SurveyImage::class);
    }

}
