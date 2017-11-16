<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Continent;
use App\Region;

class CountriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('name', 'asc')->paginate(10);
        return view('nella.countries.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $continents = Continent::orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        return view('nella.countries.create')->with(['continents' => $continents, 'regions' => $regions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'continent' => 'required',
            'region' => 'required'
        ]);

        //Create Country
        $db_country = Country::where('name', $request->input('name'))->get();
        if (count($db_country)<1){
            $country = new Country;
            $country->name = $request->input('name');
            $country->continent_id = $request->input('continent');
            $country->region_id = $request->input('region');
            $country->save();

            return redirect('/nella/countries')->with('success', 'Country Created');
        }else{
            return redirect('/nella/countries')->with('error', 'Error: Country with name '.$request->input('name').' already exists!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        return view('nella.countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        $continents = Continent::orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        return view('nella.countries.edit')->with(['country'=> $country, 'continents' => $continents, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //Update Country
        $country = Country::find($id);
        $country->name = $request->input('name');
        $country->continent_id = $request->input('continent');
        $country->region_id = $request->input('region');
        $country->save();

        return redirect('/nella/countries')->with('success', 'Country Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect('/nella/countries')->with('success', 'Country Deleted');
    }
}
