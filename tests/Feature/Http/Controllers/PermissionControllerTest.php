<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PermissionController
 */
class PermissionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $permissions = Permission::factory()->count(3)->create();

        $response = $this->get(route('permission.index'));

        $response->assertOk();
        $response->assertViewIs('permission.index');
        $response->assertViewHas('permissions');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('permission.create'));

        $response->assertOk();
        $response->assertViewIs('permission.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PermissionController::class,
            'store',
            \App\Http\Requests\PermissionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $slug = $this->faker->slug;

        $response = $this->post(route('permission.store'), [
            'name' => $name,
            'slug' => $slug,
        ]);

        $permissions = Permission::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->get();
        $this->assertCount(1, $permissions);
        $permission = $permissions->first();

        $response->assertRedirect(route('permission.index'));
        $response->assertSessionHas('permission.id', $permission->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $permission = Permission::factory()->create();

        $response = $this->get(route('permission.show', $permission));

        $response->assertOk();
        $response->assertViewIs('permission.show');
        $response->assertViewHas('permission');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $permission = Permission::factory()->create();

        $response = $this->get(route('permission.edit', $permission));

        $response->assertOk();
        $response->assertViewIs('permission.edit');
        $response->assertViewHas('permission');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PermissionController::class,
            'update',
            \App\Http\Requests\PermissionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $permission = Permission::factory()->create();
        $name = $this->faker->name;
        $slug = $this->faker->slug;

        $response = $this->put(route('permission.update', $permission), [
            'name' => $name,
            'slug' => $slug,
        ]);

        $permission->refresh();

        $response->assertRedirect(route('permission.index'));
        $response->assertSessionHas('permission.id', $permission->id);

        $this->assertEquals($name, $permission->name);
        $this->assertEquals($slug, $permission->slug);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $permission = Permission::factory()->create();

        $response = $this->delete(route('permission.destroy', $permission));

        $response->assertRedirect(route('permission.index'));

        $this->assertDeleted($permission);
    }
}
