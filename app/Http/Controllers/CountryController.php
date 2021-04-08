<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = array();
        $countries = DB::table('countries')->orderBy('name')->get();

        if($request->country_id > 0)
        {
            $companies = Company::where('country_id', '=', $request->country_id)->get();
            return view('country.index', compact('countries', 'companies'));
        } else
            return view('country.index', compact('countries', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('country.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = Country::where('name', '=', $request->name)->count();
        if ($country > 0)
            return redirect('country/add')->withInput()->with('danger', 'Country already exists');

        $input = $request->all();
        $countries = new Country($input);

        if ($countries->save())
            return Redirect::route('countries')->with('success', 'Successfully added country!');
        else
            return Redirect::route('addCountry')->withInput()->withErrors($countries->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country, $id)
    {
        $country = Country::find($id);
        return view('country.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country, $id)
    {
        $country = Country::find($id);
        $country_check = Country::where('name', '=', $request->name)->get()->first();

        if ($country_check && $country_check->id != $id)
            return Redirect::route('editCountry', [$id])->withInput()->with('danger', 'Country already exists');

        $country->name = $request->name;

        if ($country->update())
            return Redirect::route('countries')->with('success', 'Successfully updated country!');
        else
            return Redirect::route('editCountry', [$id])->withInput()->withErrors($country->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country, $id)
    {
        $country = Country::findOrFail($id);
        $company = Company::where('country_id', '=', $country->id)->first();

        if ($company)
            return Redirect::route('countries')->with('danger', 'Country has companies linked to it');
        else {
            $country->delete();
            return Redirect::route('countries')->with('success', 'Country successfully deleted!');
        }
    }
    /**
     * Ajax call to return all companies
     *
     * @return Venues
     */
    public function ajaxCompanies($country_id)
    {
        // Get log in user credentials to select only the company user is working for
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id)
            $companies = Company::where('country_id', '=', $country_id)->get();
        else
            $companies = Company::where('id', '=', $user->company_id)
                ->where('country_id', '=', $country_id)->get();
        return $companies;
    }
}
