<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Asset;
use App\Models\Inventary;
use App\Models\Point;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InventaryController
 */
class InventaryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $inventaries = Inventary::factory()->count(3)->create();

        $response = $this->get(route('inventary.index'));

        $response->assertOk();
        $response->assertViewIs('inventary.index');
        $response->assertViewHas('inventaries');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('inventary.create'));

        $response->assertOk();
        $response->assertViewIs('inventary.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventaryController::class,
            'store',
            \App\Http\Requests\InventaryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $point = Point::factory()->create();
        $asset = Asset::factory()->create();
        $units = $this->faker->word;
        $min = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('inventary.store'), [
            'point_id' => $point->id,
            'asset_id' => $asset->id,
            'units' => $units,
            'min' => $min,
        ]);

        $inventaries = Inventary::query()
            ->where('point_id', $point->id)
            ->where('asset_id', $asset->id)
            ->where('units', $units)
            ->where('min', $min)
            ->get();
        $this->assertCount(1, $inventaries);
        $inventary = $inventaries->first();

        $response->assertRedirect(route('inventary.index'));
        $response->assertSessionHas('inventary.id', $inventary->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $inventary = Inventary::factory()->create();

        $response = $this->get(route('inventary.show', $inventary));

        $response->assertOk();
        $response->assertViewIs('inventary.show');
        $response->assertViewHas('inventary');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $inventary = Inventary::factory()->create();

        $response = $this->get(route('inventary.edit', $inventary));

        $response->assertOk();
        $response->assertViewIs('inventary.edit');
        $response->assertViewHas('inventary');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventaryController::class,
            'update',
            \App\Http\Requests\InventaryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $inventary = Inventary::factory()->create();
        $point = Point::factory()->create();
        $asset = Asset::factory()->create();
        $units = $this->faker->word;
        $min = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('inventary.update', $inventary), [
            'point_id' => $point->id,
            'asset_id' => $asset->id,
            'units' => $units,
            'min' => $min,
        ]);

        $inventary->refresh();

        $response->assertRedirect(route('inventary.index'));
        $response->assertSessionHas('inventary.id', $inventary->id);

        $this->assertEquals($point->id, $inventary->point_id);
        $this->assertEquals($asset->id, $inventary->asset_id);
        $this->assertEquals($units, $inventary->units);
        $this->assertEquals($min, $inventary->min);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $inventary = Inventary::factory()->create();

        $response = $this->delete(route('inventary.destroy', $inventary));

        $response->assertRedirect(route('inventary.index'));

        $this->assertDeleted($inventary);
    }
}
