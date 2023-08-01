<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'certificate';
    protected $primaryKey = 'Certificate_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Certificate',
        'Enrollment_Id',
        'Certificate_Image',
    ];
}