<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionsController extends Controller
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
        //$continents = Continent::all();
        //$continents = Continent::where('name', 'Africa')->take(1)->get();
        //$continents = Continent::where('name', 'Africa')->paginate(1);
        $regions = Region::orderBy('name', 'asc')->paginate(10);
        return view('nella.regions.index')->with('regions', $regions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nella.regions.create');
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
            'name' => 'required'
        ]);

        //Create Region
        $region = new Region;
        $region->name = $request->input('name');
        $region->abbreviation = $request->input('abbreviation');
        $region->save();

        return redirect('/nella/regions')->with('success', 'Region Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);
        return view('nella.regions.show')->with('region', $region);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);
        return view('nella.regions.edit')->with('region', $region);
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
            'name' => 'required',
            'abbreviation' => 'required'
        ]);

        //Update Continent
        $region = Region::find($id);
        $region->name = $request->input('name');
        $region->abbreviation = $request->input('abbreviation');
        $region->save();

        return redirect('/nella/regions')->with('success', 'Region Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();
        return redirect('/nella/regions')->with('success', 'Region Deleted');
    }
}
