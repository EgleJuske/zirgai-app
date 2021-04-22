<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;

class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->horse_id) && $request->horse_id !== 0)
            $betters = \App\Models\Better::where('horse_id', $request->horse_id)->orderBy('bet', 'DESC')->get();
        else
            $betters = \App\Models\Better::orderBy('bet', 'DESC')->get();

        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('better.index', ['betters' => $betters, 'horses' => $horses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('better.create', ['horses' => $horses]);
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
            'name' => 'required|max:100',
            'surname' => 'required|unique:betters,surname|max:100',
            'bet' => 'required|numeric|gt:0',
        ]);

        $better = new Better();
        $better->fill($request->all());
        return ($better->save() !== 1) ?
            redirect('/better')->with('status_success', 'Lažybininkas "' . $request['name'] . '" pridėtas!') :
            redirect('/better.create')->with('status_error', 'Lažybininkas nebuvo pridėtas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('better.edit', ['better' => $better, 'horses' => $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'surname' => 'required|unique:betters,surname,' . $better->id . ',id|max:100',
            'bet' => 'required|numeric|gt:0',
        ]);

        $better->fill($request->all());
        return ($better->save() !== 1) ?
            redirect('/better')->with('status_success', 'Lažybininkas "' . $request['name'] . '" redaguotas!') :
            redirect('/better')->with('status_error', 'Lažybininkas nebyvo redaguotas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        $better->delete();
        return redirect()->route('better.index');
    }

    public function info($id)
    {
        $better = Better::find($id);
        return view('better.info', ['better' => $better]);
    }
}
