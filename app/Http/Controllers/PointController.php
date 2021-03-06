<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointStoreRequest;
use App\Http\Requests\PointUpdateRequest;
use App\Models\Point;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PointController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $rol)
    {
        $points = $rol->points;


        // return view('point.index', compact('points'));

        //comprobar si hay puntos relacionados a la empresa
        // if ($rol->companies()->first()->points()->count()) {
            // si hay puntos imprime la lista
            return Inertia::render('point/index',[
                'points' => $points,
                'role' => $rol
            ]);
        // }else{
            //si no hay puntos re-dirige a create
            return redirect()->route('points.create',$rol);
        // }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Role $rol)
    {
        // dd($rol);
        return Inertia::render('point/create',[
            'role' => $rol,
            'companie' => $rol->companies()->first(),
            'points' => $rol->companies()->first()->points
        ]);
    }

    /**
     * @param \App\Http\Requests\PointStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(PointStoreRequest $request, Role $rol)
    public function store(Request $request, Role $rol)
    {
        $code = Str::random(10);

        $point = Point::create([
            'company_id' => $rol->companies()->first()->id,
            'type' => $request->type,
            'comment' => $request->comment,
            'slug' => strtolower($code)
        ]);

        $rol->points()->attach($point);

        // $request->session()->flash('point.id', $point->id);

        return redirect()->route('points.index', $rol);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Point $point)
    {
        return view('point.show', compact('point'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Point $point)
    {
        return view('point.edit', compact('point'));
    }

    /**
     * @param \App\Http\Requests\PointUpdateRequest $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function update(PointUpdateRequest $request, Point $point)
    {
        $point->update($request->validated());

        $request->session()->flash('point.id', $point->id);

        return redirect()->route('point.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Point $point)
    {
        $point->delete();

        return redirect()->route('point.index');
    }
}
