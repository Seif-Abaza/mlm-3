<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Continent;

class ContinentsController extends Controller
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
        //$continents = Continent::where('name', 'Africa')->take(1)->get();
        $continents = Continent::orderBy('name', 'asc')->paginate(10);
        return view('nella.continents.index')->with('continents', $continents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nella.continents.create');
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

        //Create Continent
        $continent = new Continent;
        $continent->name = $request->input('name');
        $continent->save();

        return redirect('/nella/continents')->with('success', 'Continent Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $continent = Continent::find($id);
        return view('nella.continents.show')->with('continent', $continent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $continent = Continent::find($id);
        return view('nella.continents.edit')->with('continent', $continent);
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

        //Update Continent
        $continent = Continent::find($id);
        $continent->name = $request->input('name');
        $continent->save();

        return redirect('/nella/continents')->with('success', 'Continent Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $continent = Continent::find($id);
        $continent->delete();
        return redirect('/nella/continents')->with('success', 'Continent Deleted');
    }
}
