<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentStoreRequest;
use App\Http\Requests\DepartamentUpdateRequest;
use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departaments = Departament::all();

        return view('departament.index', compact('departaments'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('departament.create');
    }

    /**
     * @param \App\Http\Requests\DepartamentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentStoreRequest $request)
    {
        $departament = Departament::create($request->validated());

        $request->session()->flash('departament.id', $departament->id);

        return redirect()->route('departament.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departament $departament
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Departament $departament)
    {
        return view('departament.show', compact('departament'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departament $departament
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Departament $departament)
    {
        return view('departament.edit', compact('departament'));
    }

    /**
     * @param \App\Http\Requests\DepartamentUpdateRequest $request
     * @param \App\Models\Departament $departament
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentUpdateRequest $request, Departament $departament)
    {
        $departament->update($request->validated());

        $request->session()->flash('departament.id', $departament->id);

        return redirect()->route('departament.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Departament $departament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Departament $departament)
    {
        $departament->delete();

        return redirect()->route('departament.index');
    }
}
