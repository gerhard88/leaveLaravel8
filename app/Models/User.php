<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'surname', 'email', 'password', 'createRole', 'updateRole', 'deleteRole', 'addUser',
        'updateUser', 'deleteUser', 'addCountry', 'updateCountry', 'deleteCountry', 'addCompany', 'updateCompany',
        'deleteCompany', 'addDept', 'updateDept', 'deleteDept', 'addTeam', 'updateTeam', 'deleteTeam', 'addEmployeeType',
        'updateEmployeeType', 'deleteEmployeeType', 'addLeaveType', 'updateLeaveType', 'deleteLeaveType', 'addEmployee',
        'updateEmployee', 'deleteEmployee', 'attReg', 'leaveCapture', 'leaveApprove', 'settings', 'reportView', 'role_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
