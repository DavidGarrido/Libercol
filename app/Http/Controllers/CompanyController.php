<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

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
            'companies' => Company::all()->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'color' => $company->color
                ];
            }),
            'create_url' => URL::route('companies.create'),
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
        $company = Company::create($request->validated());

        $request->session()->flash('company.id', $company->id);

        return redirect()->route('companies.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Company $company)
    {
        // return view('company.show', compact('company'));
        return Inertia::render('company/show',[
            'companie' => $company,
            'edit' => URL::route('companies.edit', $company),
            'all' => URL::route('companies.index')
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Company $company)
    {
        // return view('company.edit', compact('company'));
        return Inertia::render('company/edit',[
            'companie' => $company
        ]);
    }

    /**
     * @param \App\Http\Requests\CompanyUpdateRequest $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());

        // $request->session()->flash('company.id', $company->id);

        // return redirect()->route('companies.show', $company);
        return Redirect::back()->with('success', 'Organization updated.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company)
    {
        $company->delete();

        return redirect()->route('company.index');
    }
}
