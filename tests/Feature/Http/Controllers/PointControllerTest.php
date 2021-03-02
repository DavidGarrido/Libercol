<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Point;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PointController
 */
class PointControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $points = Point::factory()->count(3)->create();

        $response = $this->get(route('point.index'));

        $response->assertOk();
        $response->assertViewIs('point.index');
        $response->assertViewHas('points');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('point.create'));

        $response->assertOk();
        $response->assertViewIs('point.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PointController::class,
            'store',
            \App\Http\Requests\PointStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $company = Company::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('point.store'), [
            'company_id' => $company->id,
            'type' => $type,
        ]);

        $points = Point::query()
            ->where('company_id', $company->id)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $points);
        $point = $points->first();

        $response->assertRedirect(route('point.index'));
        $response->assertSessionHas('point.id', $point->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $point = Point::factory()->create();

        $response = $this->get(route('point.show', $point));

        $response->assertOk();
        $response->assertViewIs('point.show');
        $response->assertViewHas('point');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $point = Point::factory()->create();

        $response = $this->get(route('point.edit', $point));

        $response->assertOk();
        $response->assertViewIs('point.edit');
        $response->assertViewHas('point');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PointController::class,
            'update',
            \App\Http\Requests\PointUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $point = Point::factory()->create();
        $company = Company::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('point.update', $point), [
            'company_id' => $company->id,
            'type' => $type,
        ]);

        $point->refresh();

        $response->assertRedirect(route('point.index'));
        $response->assertSessionHas('point.id', $point->id);

        $this->assertEquals($company->id, $point->company_id);
        $this->assertEquals($type, $point->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $point = Point::factory()->create();

        $response = $this->delete(route('point.destroy', $point));

        $response->assertRedirect(route('point.index'));

        $this->assertDeleted($point);
    }
}
