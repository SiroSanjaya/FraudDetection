<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'quiz';
     protected $primaryKey = 'Quiz_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Courses_Id',
        'Quiz_Title',
        'Quiz_Desc',
        'Quiz_Time',
        'Quiz_Kkm',
        'Quiz_Status',
    ];
}