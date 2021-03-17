<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validationRules=[
        'company_id' => 'required|numeric|digits_between:1,9999',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();
        if ($employee)
            $teams = Team::where('company_id', '=', $employee->company_id)->get();
        else
            $teams = DB::table('teams')->get();
        return view('team.index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();
        if ($employee)
            $companies = Company::where('id', '=', $employee->company_id)->get();
        else
            $companies = Company::all();
        return view('team.add', compact('companies', $companies));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        $team = Team::where('name', '=', $request->name)->count();
        if ($team > 0)
            return redirect('team/add')->withInput()->with('danger', 'Team already exists');

        $company = Company::where('id', '=', $request->company_id)->first();
        $input = $request->all();
        $team = new Team($input);
        $team->company_id = $company->id;

        if ($team->save())
            return Redirect::route('teams', ['company_id' => $company->id])->with('success', 'Successfully added team!');
        else
            return Redirect::route('addTeam')->withInput()->withErrors($team->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, $id)
    {
        $team = Team::find($id);
        $companies = Company::all();
        $tid = Team::find($id)->company_id;
        return view('team.edit', compact('team', 'companies', 'tid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team, $id)
    {
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        $team = Team::find($id);
        $team_check = Team::where('name', '=', $request->name)->get()->first();

        if ($team_check && $team_check->id != $id)
            return Redirect::route('editTeam', [$id])->withInput()->with('danger', 'Team already exists');

        $team->name = $request->name;
        $team->company_id = $request->company_id;

        if ($team->update())
            return Redirect::route('teams')->with('success', 'Successfully updated team!');
        else
            return Redirect::route('editTeam', [$id])->withInput()->withErrors($team->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, $id)
    {
        $team = Team::findOrFail($id);
        $employees = Employee::where('team_id', '=', $team->id)->first();

        if ($employees)
            return Redirect::route('teams')->with('danger', 'Team has employees linked to it');
        else {
            $team->delete();
            return Redirect::route('teams')->with('success', 'Team successfully deleted!');
        }
    }
}
