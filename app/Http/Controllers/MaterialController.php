<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialStoreRequest;
use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $materials = Material::all();

        return view('material.index', compact('materials'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('material.create');
    }

    /**
     * @param \App\Http\Requests\MaterialStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialStoreRequest $request)
    {
        $material = Material::create($request->validated());

        $request->session()->flash('material.id', $material->id);

        return redirect()->route('material.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Material $material)
    {
        return view('material.show', compact('material'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Material $material)
    {
        return view('material.edit', compact('material'));
    }

    /**
     * @param \App\Http\Requests\MaterialUpdateRequest $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialUpdateRequest $request, Material $material)
    {
        $material->update($request->validated());

        $request->session()->flash('material.id', $material->id);

        return redirect()->route('material.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Material $material)
    {
        $material->delete();

        return redirect()->route('material.index');
    }
}
