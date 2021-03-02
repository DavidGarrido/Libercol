<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MaterialController
 */
class MaterialControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $materials = Material::factory()->count(3)->create();

        $response = $this->get(route('material.index'));

        $response->assertOk();
        $response->assertViewIs('material.index');
        $response->assertViewHas('materials');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('material.create'));

        $response->assertOk();
        $response->assertViewIs('material.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterialController::class,
            'store',
            \App\Http\Requests\MaterialStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $slug = $this->faker->slug;

        $response = $this->post(route('material.store'), [
            'name' => $name,
            'slug' => $slug,
        ]);

        $materials = Material::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->get();
        $this->assertCount(1, $materials);
        $material = $materials->first();

        $response->assertRedirect(route('material.index'));
        $response->assertSessionHas('material.id', $material->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $material = Material::factory()->create();

        $response = $this->get(route('material.show', $material));

        $response->assertOk();
        $response->assertViewIs('material.show');
        $response->assertViewHas('material');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $material = Material::factory()->create();

        $response = $this->get(route('material.edit', $material));

        $response->assertOk();
        $response->assertViewIs('material.edit');
        $response->assertViewHas('material');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterialController::class,
            'update',
            \App\Http\Requests\MaterialUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $material = Material::factory()->create();
        $name = $this->faker->name;
        $slug = $this->faker->slug;

        $response = $this->put(route('material.update', $material), [
            'name' => $name,
            'slug' => $slug,
        ]);

        $material->refresh();

        $response->assertRedirect(route('material.index'));
        $response->assertSessionHas('material.id', $material->id);

        $this->assertEquals($name, $material->name);
        $this->assertEquals($slug, $material->slug);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $material = Material::factory()->create();

        $response = $this->delete(route('material.destroy', $material));

        $response->assertRedirect(route('material.index'));

        $this->assertDeleted($material);
    }
}
