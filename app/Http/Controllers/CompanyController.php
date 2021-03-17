<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\Department;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validationRules=[
        'country_id' => 'required|numeric|digits_between:1,9999',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = array();
        $teams = array();

        $countries = DB::table('countries')->orderBy('name')->get();
        $companies = DB::table('companies')->orderBy('name')->get();

        $currentCompanies = array();
        foreach ($companies as $company) {
            $currentCompany = new CurrentCompany();
            $currentCompany->companyId = $company->id;
            $currentCompany->companyName = $company->name;
            $country = Country::find($company->country_id);
            $currentCompany->countryName = $country->name;
            array_push($currentCompanies, $currentCompany);
        }

        if($request->company_id > 0)
        {
            $departments = Department::where('company_id', '=', $request->company_id)->get();
            $teams = Team::where('company_id', '=', $request->company_id)->get();
            return view('company.index', compact('countries', 'currentCompanies', 'departments', 'teams'));
        } else
            return view('company.index', compact('countries', 'currentCompanies', 'departments', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $countries = Country::all();
        return view('company.add', compact('countries'));
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

        $company = Company::where('name', '=', $request->name)->count();
        if ($company > 0)
            return redirect('company/add')->withInput()->with('danger', 'Company already exists');

        $country = Country::where('id', '=', $request->country_id)->first();
        $input = $request->all();
        $company = new Company($input);

        if ($company->save())
            return Redirect::route('companies', ['country_id' => $country->id])->with('success', 'Successfully added company!');
        else
            return Redirect::route('addCompany')->withInput()->withErrors($company->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, $id)
    {
        $company = Company::find($id);
        $countries = Country::all();
        $cid = Company::find($id)->country_id;
        return view('company.edit', compact('countries', 'company', 'cid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, $id)
    {
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        $company = Company::find($id);
        $company_check = Company::where('name', '=', $request->name)->get()->first();

        if ($company_check && $company_check->id != $id)
            return Redirect::route('editCompany', [$id])->withInput()->with('danger', 'Company already exists');

        $company->name = $request->name;

        if ($company->update())
            return Redirect::route('companies')->with('success', 'Successfully updated company!');
        else
            return Redirect::route('editCompany', [$id])->withInput()->withErrors($company->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, $id)
    {
        $company = Company::findOrFail($id);
        $department = Department::where('company_id', '=', $company->id)->first();

        if ($department)
            return Redirect::route('companies')->with('danger', 'Company has departments linked to it');
        else {
            $team = Team::where('company_id', '=', $company->id)->first();

            if ($team)
                return Redirect::route('companies')->with('danger', 'Company has teams linked to it');
            else {
                $company->delete();
                return Redirect::route('companies')->with('success', 'Company successfully deleted!');
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function departments($id)
    {
        $company = Company::find($id);
        $departments = Department::where('company_id', '=', $company->id)->get();

        return view('company.depts', compact('company', 'departments'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teams($id)
    {
        $company = Company::find($id);
        $teams= Team::where('company_id', '=', $company->id)->get();

        return view('company.teams', compact('company', 'teams'));
    }
    /**
     * Ajax call to return all departments
     *
     * @return Venues
     */
    public function ajaxDepartments($company_id)
    {
        //only show all departments to a company
        $departments = Department::where('company_id','=',$company_id)->get();
        return $departments;
    }
    /**
     * Ajax call to return all departments
     *
     * @return Venues
     */
    public function ajaxTeams($company_id)
    {
        //only show all teams to a company
        $teams = Team::where('company_id','=',$company_id)->get();
        return $teams;
    }
}
class CurrentCompany {
    public $companyId;
    public $companyName;
    public $countryName;
}
