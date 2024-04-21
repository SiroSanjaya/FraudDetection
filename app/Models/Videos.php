<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $table = 'videos';
     protected $primaryKey = 'Video_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Video_Title',
        'Video_Desc',
        'Video_Link',
        'Video_Thumbnail',
    ];

    public static function VideosByCourses($coursesTitle)
    {
        return static::whereIn('Video_Id', function ($subquery) use ($coursesTitle) {
            $subquery->select('Video_Id')
                ->from('category_video')
                ->whereIn('Courses_Id', function ($innerSubquery) use ($coursesTitle) {
                    $innerSubquery->select('Courses_Id')
                        ->from('courses')
                        ->where('Courses_Title', $coursesTitle);
                });
        })->get();
    }
}