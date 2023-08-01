<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'enroll';
    protected $primaryKey = 'Enroll_Id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'Enrollment_Id',
        'User_Id',
        'Enroll_Date',
        'Enroll_Status',
    ];
    public static function DataEnroll()
    {
        return static::select('enroll.*', 'users.username', 'bisnis_unit.Bisnis_Unit_Name')
            ->join('users', 'enroll.User_Id', '=', 'users.User_Id')
            ->join('bisnis_unit', 'users.Bisnis_Unit_Id', '=', 'bisnis_unit.Bisnis_Unit_Id')
            ->get();
    }
}
