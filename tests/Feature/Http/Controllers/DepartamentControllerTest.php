<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Departament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DepartamentController
 */
class DepartamentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $departaments = Departament::factory()->count(3)->create();

        $response = $this->get(route('departament.index'));

        $response->assertOk();
        $response->assertViewIs('departament.index');
        $response->assertViewHas('departaments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('departament.create'));

        $response->assertOk();
        $response->assertViewIs('departament.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepartamentController::class,
            'store',
            \App\Http\Requests\DepartamentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('departament.store'), [
            'name' => $name,
        ]);

        $departaments = Departament::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $departaments);
        $departament = $departaments->first();

        $response->assertRedirect(route('departament.index'));
        $response->assertSessionHas('departament.id', $departament->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $departament = Departament::factory()->create();

        $response = $this->get(route('departament.show', $departament));

        $response->assertOk();
        $response->assertViewIs('departament.show');
        $response->assertViewHas('departament');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $departament = Departament::factory()->create();

        $response = $this->get(route('departament.edit', $departament));

        $response->assertOk();
        $response->assertViewIs('departament.edit');
        $response->assertViewHas('departament');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepartamentController::class,
            'update',
            \App\Http\Requests\DepartamentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $departament = Departament::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('departament.update', $departament), [
            'name' => $name,
        ]);

        $departament->refresh();

        $response->assertRedirect(route('departament.index'));
        $response->assertSessionHas('departament.id', $departament->id);

        $this->assertEquals($name, $departament->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $departament = Departament::factory()->create();

        $response = $this->delete(route('departament.destroy', $departament));

        $response->assertRedirect(route('departament.index'));

        $this->assertDeleted($departament);
    }
}
