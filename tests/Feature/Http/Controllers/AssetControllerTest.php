<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Asset;
use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AssetController
 */
class AssetControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $assets = Asset::factory()->count(3)->create();

        $response = $this->get(route('asset.index'));

        $response->assertOk();
        $response->assertViewIs('asset.index');
        $response->assertViewHas('assets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('asset.create'));

        $response->assertOk();
        $response->assertViewIs('asset.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssetController::class,
            'store',
            \App\Http\Requests\AssetStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $slug = $this->faker->slug;
        $description = $this->faker->text;
        $creator = Creator::factory()->create();
        $valoration = $this->faker->numberBetween(-100000, 100000);

        $response = $this->post(route('asset.store'), [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'creator_id' => $creator->id,
            'valoration' => $valoration,
        ]);

        $assets = Asset::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('description', $description)
            ->where('creator_id', $creator->id)
            ->where('valoration', $valoration)
            ->get();
        $this->assertCount(1, $assets);
        $asset = $assets->first();

        $response->assertRedirect(route('asset.index'));
        $response->assertSessionHas('asset.id', $asset->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $asset = Asset::factory()->create();

        $response = $this->get(route('asset.show', $asset));

        $response->assertOk();
        $response->assertViewIs('asset.show');
        $response->assertViewHas('asset');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $asset = Asset::factory()->create();

        $response = $this->get(route('asset.edit', $asset));

        $response->assertOk();
        $response->assertViewIs('asset.edit');
        $response->assertViewHas('asset');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssetController::class,
            'update',
            \App\Http\Requests\AssetUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $asset = Asset::factory()->create();
        $name = $this->faker->name;
        $slug = $this->faker->slug;
        $description = $this->faker->text;
        $creator = Creator::factory()->create();
        $valoration = $this->faker->numberBetween(-100000, 100000);

        $response = $this->put(route('asset.update', $asset), [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'creator_id' => $creator->id,
            'valoration' => $valoration,
        ]);

        $asset->refresh();

        $response->assertRedirect(route('asset.index'));
        $response->assertSessionHas('asset.id', $asset->id);

        $this->assertEquals($name, $asset->name);
        $this->assertEquals($slug, $asset->slug);
        $this->assertEquals($description, $asset->description);
        $this->assertEquals($creator->id, $asset->creator_id);
        $this->assertEquals($valoration, $asset->valoration);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $asset = Asset::factory()->create();

        $response = $this->delete(route('asset.destroy', $asset));

        $response->assertRedirect(route('asset.index'));

        $this->assertDeleted($asset);
    }
}
