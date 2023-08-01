<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'enrollment';
    protected $primaryKey = 'Enrollment_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Enrollment_Title',
        'Enrollment_Desc',
        'Category_Courses_Id',
        'Enrollment_Start',
        'Enrollment_End',
    ];
    public static function DataEnrollment()
    {
        return static::select('enrollment.*', 'certificate.Certificate_Image', 'category_courses.Category_Id')
            ->join('category_courses', 'Enrollment.Category_Courses_Id', '=', 'category_courses.Category_Id')
            ->join('certificate', 'certificate.Enrollment_Id', '=', 'enrollment.Enrollment_Id')
            ->get();
    }
}