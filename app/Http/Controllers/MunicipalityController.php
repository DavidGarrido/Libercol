<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipalityStoreRequest;
use App\Http\Requests\MunicipalityUpdateRequest;
use App\Models\Municipality;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $municipalities = Municipality::all();

        return view('municipality.index', compact('municipalities'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('municipality.create');
    }

    /**
     * @param \App\Http\Requests\MunicipalityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipalityStoreRequest $request)
    {
        $municipality = Municipality::create($request->validated());

        $request->session()->flash('municipality.id', $municipality->id);

        return redirect()->route('municipality.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Municipality $municipality)
    {
        return view('municipality.show', compact('municipality'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Municipality $municipality)
    {
        return view('municipality.edit', compact('municipality'));
    }

    /**
     * @param \App\Http\Requests\MunicipalityUpdateRequest $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(MunicipalityUpdateRequest $request, Municipality $municipality)
    {
        $municipality->update($request->validated());

        $request->session()->flash('municipality.id', $municipality->id);

        return redirect()->route('municipality.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Municipality $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Municipality $municipality)
    {
        $municipality->delete();

        return redirect()->route('municipality.index');
    }
}
