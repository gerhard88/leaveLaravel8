<?php

namespace App\Http\Controllers;

use Acaronlex\LaravelCalendar\Facades\Calendar;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        {
            $leaves = [];

            $user = User::where('name', '=', Auth::user()->name)
                ->where('surname', '=', Auth::user()->surname)->first();

            $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

            $data = Leave::where('approved', '=', 'Y')->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    if ($role->id == $user->role_id)
                        $employee = Employee::find($value->employee_id);
                    else
                        $employee = Employee::where('id', '=', $value->employee_id)
                            ->where('company_id', '=', $user->company_id)->first();

                    if ($employee) {
                        $name = $employee->name . ' ' . $employee->surname;
                        $leaveType = LeaveType::find($value->leaveType_id);
                        $type = $leaveType->type;

                        $content = $name . "\n" . $type;

                        $leaves[] = Calendar::event(
                            $content,
                            true,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date . '+1 day'),
                            null,
                            // Add color
                            [
                                'color' => '#000000',
                                'textColor' => '#008000',
                            ]
                        );
                    }
                }
            }
            $calendar = Calendar::addEvents($leaves);
            return view('calendar.index', compact('calendar'));
        }
    }
}

