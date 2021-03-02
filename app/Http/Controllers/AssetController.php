<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetStoreRequest;
use App\Http\Requests\AssetUpdateRequest;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assets = Asset::all();

        return view('asset.index', compact('assets'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('asset.create');
    }

    /**
     * @param \App\Http\Requests\AssetStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetStoreRequest $request)
    {
        $asset = Asset::create($request->validated());

        $request->session()->flash('asset.id', $asset->id);

        return redirect()->route('asset.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Asset $asset)
    {
        return view('asset.show', compact('asset'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Asset $asset)
    {
        return view('asset.edit', compact('asset'));
    }

    /**
     * @param \App\Http\Requests\AssetUpdateRequest $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function update(AssetUpdateRequest $request, Asset $asset)
    {
        $asset->update($request->validated());

        $request->session()->flash('asset.id', $asset->id);

        return redirect()->route('asset.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Asset $asset)
    {
        $asset->delete();

        return redirect()->route('asset.index');
    }
}
