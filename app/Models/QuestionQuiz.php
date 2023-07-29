<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionQuiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'question_quiz';
    protected $primaryKey = 'Question_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Quiz_Id',
        'Question',
    ];

    public function option()
    {
        return $this->hasMany(OptionQuestion::class, 'Question_Id');
    }

    public function answer()
    {
        return $this->hasMany(AnswereQuestion::class, 'Question_Id');
    }

    public static function GetAllQuiz($QuizID)
    {
        return static::where('Quiz_Id', $QuizID)
            ->with('option')
            ->with('answer')
            ->get();
    }
}
