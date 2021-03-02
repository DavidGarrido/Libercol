<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Wallet;
use App\Models\Wallettype;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WalletController
 */
class WalletControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $wallets = Wallet::factory()->count(3)->create();

        $response = $this->get(route('wallet.index'));

        $response->assertOk();
        $response->assertViewIs('wallet.index');
        $response->assertViewHas('wallets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('wallet.create'));

        $response->assertOk();
        $response->assertViewIs('wallet.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WalletController::class,
            'store',
            \App\Http\Requests\WalletStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $modeltable_type = $this->faker->word;
        $modeltable_id = $this->faker->randomNumber();
        $wallettype = Wallettype::factory()->create();

        $response = $this->post(route('wallet.store'), [
            'modeltable_type' => $modeltable_type,
            'modeltable_id' => $modeltable_id,
            'wallettype_id' => $wallettype->id,
        ]);

        $wallets = Wallet::query()
            ->where('modeltable_type', $modeltable_type)
            ->where('modeltable_id', $modeltable_id)
            ->where('wallettype_id', $wallettype->id)
            ->get();
        $this->assertCount(1, $wallets);
        $wallet = $wallets->first();

        $response->assertRedirect(route('wallet.index'));
        $response->assertSessionHas('wallet.id', $wallet->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->get(route('wallet.show', $wallet));

        $response->assertOk();
        $response->assertViewIs('wallet.show');
        $response->assertViewHas('wallet');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->get(route('wallet.edit', $wallet));

        $response->assertOk();
        $response->assertViewIs('wallet.edit');
        $response->assertViewHas('wallet');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WalletController::class,
            'update',
            \App\Http\Requests\WalletUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $wallet = Wallet::factory()->create();
        $modeltable_type = $this->faker->word;
        $modeltable_id = $this->faker->randomNumber();
        $wallettype = Wallettype::factory()->create();

        $response = $this->put(route('wallet.update', $wallet), [
            'modeltable_type' => $modeltable_type,
            'modeltable_id' => $modeltable_id,
            'wallettype_id' => $wallettype->id,
        ]);

        $wallet->refresh();

        $response->assertRedirect(route('wallet.index'));
        $response->assertSessionHas('wallet.id', $wallet->id);

        $this->assertEquals($modeltable_type, $wallet->modeltable_type);
        $this->assertEquals($modeltable_id, $wallet->modeltable_id);
        $this->assertEquals($wallettype->id, $wallet->wallettype_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->delete(route('wallet.destroy', $wallet));

        $response->assertRedirect(route('wallet.index'));

        $this->assertDeleted($wallet);
    }
}
