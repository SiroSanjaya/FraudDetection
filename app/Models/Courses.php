<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'courses';
     protected $primaryKey = 'Courses_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Category_Id',
        'Courses_Title',
        'Courses_Desc',
        'Courses_Module',
        'Courses_Image',
    ];

    
    public static function CoursesByVideo()
    {
        return static::whereIn('Courses_Id', function ($query) {
            $query->select('Courses_Id')
                ->from('category_video')
                ->whereIn('Courses_Id', function ($innerQuery) {
                    $innerQuery->select('Courses_Id')
                        ->from('courses');
                });
        })->get();
    }

    public static function CoursesByQuiz()
    {
        return static::whereIn('Courses_Id', function ($query) {
            $query->select('Courses_Id')
                ->from('quiz')
                ->whereIn('Courses_Id', function ($innerQuery) {
                    $innerQuery->select('Courses_Id')
                        ->from('courses');
                });
        })->get();
    }


}