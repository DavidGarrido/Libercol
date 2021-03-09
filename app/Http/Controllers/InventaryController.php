<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventaryStoreRequest;
use App\Http\Requests\InventaryUpdateRequest;
use App\Models\Inventary;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventaryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        $inventaries = Inventary::all();
        return Inertia::render('inventary/index',[
            'role' => $role,
            'companie' => $role->companies[0],
            'inventaries' => $inventaries
        ]);
        // return view('inventary.index', compact('inventaries'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('inventary.create');
    }

    /**
     * @param \App\Http\Requests\InventaryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventaryStoreRequest $request)
    {
        $inventary = Inventary::create($request->validated());

        $request->session()->flash('inventary.id', $inventary->id);

        return redirect()->route('inventary.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventary $inventary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Inventary $inventary)
    {
        return view('inventary.show', compact('inventary'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventary $inventary
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Inventary $inventary)
    {
        return view('inventary.edit', compact('inventary'));
    }

    /**
     * @param \App\Http\Requests\InventaryUpdateRequest $request
     * @param \App\Models\Inventary $inventary
     * @return \Illuminate\Http\Response
     */
    public function update(InventaryUpdateRequest $request, Inventary $inventary)
    {
        $inventary->update($request->validated());

        $request->session()->flash('inventary.id', $inventary->id);

        return redirect()->route('inventary.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventary $inventary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Inventary $inventary)
    {
        $inventary->delete();

        return redirect()->route('inventary.index');
    }
}
