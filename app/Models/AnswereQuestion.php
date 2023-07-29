<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswereQuestion extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'answare_question';
     protected $primaryKey = 'Answere_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Question_Id',
        'Answare',
        'Is_Correct',
    ];
}
