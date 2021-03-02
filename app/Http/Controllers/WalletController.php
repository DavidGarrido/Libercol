<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Http\Requests\WalletUpdateRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wallets = Wallet::all();

        return view('wallet.index', compact('wallets'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('wallet.create');
    }

    /**
     * @param \App\Http\Requests\WalletStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletStoreRequest $request)
    {
        $wallet = Wallet::create($request->validated());

        $request->session()->flash('wallet.id', $wallet->id);

        return redirect()->route('wallet.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Wallet $wallet)
    {
        return view('wallet.show', compact('wallet'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Wallet $wallet)
    {
        return view('wallet.edit', compact('wallet'));
    }

    /**
     * @param \App\Http\Requests\WalletUpdateRequest $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $wallet->update($request->validated());

        $request->session()->flash('wallet.id', $wallet->id);

        return redirect()->route('wallet.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Wallet $wallet)
    {
        $wallet->delete();

        return redirect()->route('wallet.index');
    }
}
