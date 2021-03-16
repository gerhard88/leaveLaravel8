<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['employee_no', 'surname', 'name', 'dob', 'idType', 'idNo', 'gender', 'contact_no', 'start_date',
        'occupation', 'email', 'employeeType_id', 'dept_id', 'team_id', 'company_id', 'country_id'];
}
