<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointStoreRequest;
use App\Http\Requests\PointUpdateRequest;
use App\Models\Point;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PointController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $points = Point::all();

        // return view('point.index', compact('points'));
        return Inertia::render('point/index',['points' => $points]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('point.create');
    }

    /**
     * @param \App\Http\Requests\PointStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointStoreRequest $request)
    {
        $point = Point::create($request->validated());

        $request->session()->flash('point.id', $point->id);

        return redirect()->route('point.index');
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
