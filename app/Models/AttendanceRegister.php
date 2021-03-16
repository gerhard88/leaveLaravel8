<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRegister extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attendanceRegister';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dayOfWeek', 'register', 'employeeType_id', 'employee_id'];
}
