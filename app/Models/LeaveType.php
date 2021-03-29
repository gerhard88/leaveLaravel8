<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leaveTypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'daysPerCycle', 'cycle_length'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public static function all($columns = ['*'])
    {//override function to order by type
        $columns = is_array($columns) ? $columns : func_get_args();

        $instance = new static;

        return $instance->newQuery()->orderBy('type')->get($columns);
    }
}
