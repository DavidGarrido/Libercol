<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RoleController
 */
class RoleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $roles = Role::factory()->count(3)->create();

        $response = $this->get(route('role.index'));

        $response->assertOk();
        $response->assertViewIs('role.index');
        $response->assertViewHas('roles');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('role.create'));

        $response->assertOk();
        $response->assertViewIs('role.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoleController::class,
            'store',
            \App\Http\Requests\RoleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $slug = $this->faker->slug;
        $code = $this->faker->word;

        $response = $this->post(route('role.store'), [
            'name' => $name,
            'slug' => $slug,
            'code' => $code,
        ]);

        $roles = Role::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('code', $code)
            ->get();
        $this->assertCount(1, $roles);
        $role = $roles->first();

        $response->assertRedirect(route('role.index'));
        $response->assertSessionHas('role.id', $role->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $role = Role::factory()->create();

        $response = $this->get(route('role.show', $role));

        $response->assertOk();
        $response->assertViewIs('role.show');
        $response->assertViewHas('role');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $role = Role::factory()->create();

        $response = $this->get(route('role.edit', $role));

        $response->assertOk();
        $response->assertViewIs('role.edit');
        $response->assertViewHas('role');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoleController::class,
            'update',
            \App\Http\Requests\RoleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $role = Role::factory()->create();
        $name = $this->faker->name;
        $slug = $this->faker->slug;
        $code = $this->faker->word;

        $response = $this->put(route('role.update', $role), [
            'name' => $name,
            'slug' => $slug,
            'code' => $code,
        ]);

        $role->refresh();

        $response->assertRedirect(route('role.index'));
        $response->assertSessionHas('role.id', $role->id);

        $this->assertEquals($name, $role->name);
        $this->assertEquals($slug, $role->slug);
        $this->assertEquals($code, $role->code);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $role = Role::factory()->create();

        $response = $this->delete(route('role.destroy', $role));

        $response->assertRedirect(route('role.index'));

        $this->assertDeleted($role);
    }
}
