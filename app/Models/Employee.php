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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static function all($columns = ['*'])
    {//override function to order by employee_no
        $columns = is_array($columns) ? $columns : func_get_args();

        $instance = new static;

        return $instance->newQuery()->orderBy('employee_no')->get($columns);
    }
}
