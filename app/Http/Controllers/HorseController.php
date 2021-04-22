<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('horse.index', ['horses' => Horse::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');
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
            'name' => 'required|unique:horses,name|max:100',
            'wins' => 'required|integer|min:0|max:127',
            'runs' => 'required|integer|min:0|max:127',
            'about' => 'required|max:255',
        ]);

        $horse = new Horse();
        $horse->fill($request->all());
        return ($horse->save() !== 1) ?
            redirect('/horse')->with('status_success', 'Arklys "' . $request['name'] . '" pridėtas!') :
            redirect('/horse.create')->with('status_error', 'Arklys nebyuvo pridėtas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horse.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $this->validate($request, [
            'name' => 'required|unique:horses,name,' . $horse->id . ',id|max:100',
            'runs' => 'required|integer|min:0|max:127',
            'wins' => 'required|integer|min:0|lte:runs',
            'about' => 'required|max:255',
        ]);

        $horse->fill($request->all());
        return ($horse->save() !== 1) ?
            redirect('/horse')->with('status_success', 'Arklys "' . $request['name'] . '" redaguotas!') :
            redirect('/horse')->with('status_error', 'Arklys nebuvo redaguotas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {

        if (count($horse->betters)) {
            return back()->with('status_error', 'Negalima ištrinti arklio ' . $horse->name . ', jis turi priskirtų lažybininkų!');
        }
        $horse->delete();
        return redirect()->route('horse.index');
    }
}
