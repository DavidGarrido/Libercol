<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Departament;
use App\Models\Municipality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MunicipalityController
 */
class MunicipalityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $municipalities = Municipality::factory()->count(3)->create();

        $response = $this->get(route('municipality.index'));

        $response->assertOk();
        $response->assertViewIs('municipality.index');
        $response->assertViewHas('municipalities');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('municipality.create'));

        $response->assertOk();
        $response->assertViewIs('municipality.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MunicipalityController::class,
            'store',
            \App\Http\Requests\MunicipalityStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $slug = $this->faker->slug;
        $code = $this->faker->numberBetween(-10000, 10000);
        $departament = Departament::factory()->create();

        $response = $this->post(route('municipality.store'), [
            'name' => $name,
            'slug' => $slug,
            'code' => $code,
            'departament_id' => $departament->id,
        ]);

        $municipalities = Municipality::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('code', $code)
            ->where('departament_id', $departament->id)
            ->get();
        $this->assertCount(1, $municipalities);
        $municipality = $municipalities->first();

        $response->assertRedirect(route('municipality.index'));
        $response->assertSessionHas('municipality.id', $municipality->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->get(route('municipality.show', $municipality));

        $response->assertOk();
        $response->assertViewIs('municipality.show');
        $response->assertViewHas('municipality');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->get(route('municipality.edit', $municipality));

        $response->assertOk();
        $response->assertViewIs('municipality.edit');
        $response->assertViewHas('municipality');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MunicipalityController::class,
            'update',
            \App\Http\Requests\MunicipalityUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $municipality = Municipality::factory()->create();
        $name = $this->faker->name;
        $slug = $this->faker->slug;
        $code = $this->faker->numberBetween(-10000, 10000);
        $departament = Departament::factory()->create();

        $response = $this->put(route('municipality.update', $municipality), [
            'name' => $name,
            'slug' => $slug,
            'code' => $code,
            'departament_id' => $departament->id,
        ]);

        $municipality->refresh();

        $response->assertRedirect(route('municipality.index'));
        $response->assertSessionHas('municipality.id', $municipality->id);

        $this->assertEquals($name, $municipality->name);
        $this->assertEquals($slug, $municipality->slug);
        $this->assertEquals($code, $municipality->code);
        $this->assertEquals($departament->id, $municipality->departament_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->delete(route('municipality.destroy', $municipality));

        $response->assertRedirect(route('municipality.index'));

        $this->assertDeleted($municipality);
    }
}
