<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leave';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_date', 'end_date', 'approved', 'leaveType_id', 'employee_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static function all($columns = ['*'])
    {//override function to order by leaveType_id
        $columns = is_array($columns) ? $columns : func_get_args();

        $instance = new static;

        return $instance->newQuery()->orderBy('leaveType_id')->get($columns);
    }
}
