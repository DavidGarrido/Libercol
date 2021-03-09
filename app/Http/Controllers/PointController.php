<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointStoreRequest;
use App\Http\Requests\PointUpdateRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Departament;
use App\Models\Point;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PointController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        $points = $role->points;


        // return view('point.index', compact('points'));

        //comprobar si hay puntos relacionados a la empresa
        // if ($rol->companies()->first()->points()->count()) {
            // si hay puntos imprime la lista
            return Inertia::render('point/index',[
                'points' => $points,
                'role' => $role,
                'companie' => $role->companies[0]
            ]);
        // }else{
            //si no hay puntos re-dirige a create
            return redirect()->route('points.create',$role);
        // }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Role $role)
    {
        // dd($rol);
        return Inertia::render('point/create',[
            'role' => $role,
            'companie' => $role->companies()->first(),
            'points' => $role->companies()->first()->points,
            'departaments' => Departament::all()
        ]);
    }

    /**
     * @param \App\Http\Requests\PointStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    // public function store(PointStoreRequest $request, Role $rol)
    public function store(Request $request, Role $role)
    {
        $code = Str::random(10);
        $request->validate([
            'address' => 'required'
        ]);
        
        $point = Point::create([
            'company_id' => $role->companies()->first()->id,
            'type' => $request->type,
            'comment' => $request->comment,
            'slug' => strtolower($code)
        ]);
        $address = Address::create([
            'description_id' => $request->address,
            'municipality_id' => $request->mun
        ]);
        $contact = Contact::create([
            'tel' => $request->tel,
            'cel_one' => $request->cel_one,
            'cel_two' => $request->cel_two,
            'whatsapp' => $request->whatsapp,
            'telegram' => $request->telegram,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'email' => $request->email,
            'web' => $request->web,
            'address_id' => $address->id,
            'modeltable_type' => 'App\Models\Point',
            'modeltable_id' => $point->id
        ]);

        $role->points()->attach($point);

        // $request->session()->flash('point.id', $point->id);

        return Redirect::route('points.index', $role)->with('success', 'Punto creado correctamente.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role, Point $point)
    {
        return Inertia::render('point/show', [
            'point' => $point,
            'role' => $role,
            'companie' => $role->companies()->first(),
            'contact' => $point->contact()->with('address')->first(),
            'companie' => $role->companies[0]
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role, Point $point)
    {
        return Inertia::render('point/edit', [
            'point' => $point,
            'role' => $role,
            'contact' => $point->contact()->with('address')->first(),
            'departaments' => Departament::all(),
            'municipal' => $point->contact[0]->address->municipality()->with('departament')->first(),
            'companie' => $role->companies[0]
        ]);
    }

    /**
     * @param \App\Http\Requests\PointUpdateRequest $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, Point $point)
    {
        $request->validate([
            'address' => 'required'
        ]);
        $point->update([
            'type' => $request->type,
            'comment' => $request->comment,
        ]);
        $point->contact()->update([
            'tel' => $request->tel,
            'cel_one' => $request->cel_one,
            'cel_two' => $request->cel_two,
            'whatsapp' => $request->whatsapp,
            'telegram' => $request->telegram,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'email' => $request->email,
            'web' => $request->web,
        ]);
        $point->contact[0]->address()->update([
            'description_id' => $request->address,
            'municipality_id' => $request->mun
        ]);

        $request->session()->flash('point.id', $point->id);

        return Redirect::route('points.show',[$role, $point])->with('success', 'Se actualizo la informacion del punto.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role, Point $point)
    {
        $point->contact[0]->address()->delete();
        $point->contact()->delete();
        $point->delete();
        // $point->delete();

        return Redirect::route('points.index', $role)->with('success', 'Se ha eliminado el punto.');
    }
}
