<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCourses extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'category_courses';
    protected $primaryKey = 'Category_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Category_Name',
        'Category_Desc',
        'Category_Image',
        'Bisnis_Unit_Id',
    ];
}