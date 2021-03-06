<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('company.index', compact('companies'));

        return Inertia::render('company/index',[
            'roles' => auth()->user()->roles()->with('companies')->get()
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('company.create');
        return Inertia::render('company/create');
    }

    /**
     * @param \App\Http\Requests\CompanyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $request->validated();
        $company = Company::create([
            'name' => $request->name,
            'color' => $request->color,
            'slug' => strtolower(str_replace(' ', '-', str_replace('.', '', $request->name))),
        ]);

        //generamos codigo unico para el rol
        $code = Str::random(10);

        //createmos el slug para el rol
        $slug_role = 'superadmin-'.$company->name.'-'.strtolower($code);

        $role = Role::create([
            'name' => 'SuperAdmin',
            //quitamos espacios y puntos el el slug
            'slug' => strtolower(str_replace(' ', '-', str_replace('.', '', $slug_role))),
            'code' => $code
        ]);

        $role->companies()->attach($company);
        $role->users()->attach(auth()->user()->id);



        return Redirect::route('points.index',$role)->with('success', 'Empresa creada.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $rol, Company $company )
    {
        // return view('company.show', compact('company'));
        return Inertia::render('company/show',[
            'companie' => $company,
            'role' => $rol
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $rol, Company $company)
    {
        // return view('company.edit', compact('company'));
        return Inertia::render('company/edit',[
            'companie' => $company,
            'role' => $rol
        ]);
    }

    /**
     * @param \App\Http\Requests\CompanyUpdateRequest $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Role $rol, Company $company)
    {
        $company->update($request->validated());

        // $request->session()->flash('company.id', $company->id);

        // return redirect()->route('companies.show', $company);
        return Redirect::route('companies.show', [$rol, $company])->with('success', 'Organization updated.');
        // return Redirect::route('companies.show', $company);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $rol, Company $company)
    {
        foreach($company->roles as $role){
            $role->delete();
        }
        $company->delete();

        // return redirect()->route('company.index');
        return Redirect::route('companie')->with('success', 'Empresa Eliminada');
    }
}
