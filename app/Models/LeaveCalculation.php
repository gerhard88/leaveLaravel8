<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCalculation extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leaveCalculation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['work_daysPerWeek', 'leaveDays_accumulated', 'leaveDays_taken', 'leaveType_id', 'employee_id'];
}
