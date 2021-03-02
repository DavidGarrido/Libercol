<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Creator;
use App\Models\Point;
use App\Models\Ticket;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TicketController
 */
class TicketControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $tickets = Ticket::factory()->count(3)->create();

        $response = $this->get(route('ticket.index'));

        $response->assertOk();
        $response->assertViewIs('ticket.index');
        $response->assertViewHas('tickets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('ticket.create'));

        $response->assertOk();
        $response->assertViewIs('ticket.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketController::class,
            'store',
            \App\Http\Requests\TicketStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $total = $this->faker->numberBetween(-100000, 100000);
        $utc = $this->faker->numberBetween(-100000, 100000);
        $point = Point::factory()->create();
        $creator = Creator::factory()->create();
        $vendor = Vendor::factory()->create();

        $response = $this->post(route('ticket.store'), [
            'total' => $total,
            'utc' => $utc,
            'point_id' => $point->id,
            'creator_id' => $creator->id,
            'vendor_id' => $vendor->id,
        ]);

        $tickets = Ticket::query()
            ->where('total', $total)
            ->where('utc', $utc)
            ->where('point_id', $point->id)
            ->where('creator_id', $creator->id)
            ->where('vendor_id', $vendor->id)
            ->get();
        $this->assertCount(1, $tickets);
        $ticket = $tickets->first();

        $response->assertRedirect(route('ticket.index'));
        $response->assertSessionHas('ticket.id', $ticket->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get(route('ticket.show', $ticket));

        $response->assertOk();
        $response->assertViewIs('ticket.show');
        $response->assertViewHas('ticket');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get(route('ticket.edit', $ticket));

        $response->assertOk();
        $response->assertViewIs('ticket.edit');
        $response->assertViewHas('ticket');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TicketController::class,
            'update',
            \App\Http\Requests\TicketUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ticket = Ticket::factory()->create();
        $total = $this->faker->numberBetween(-100000, 100000);
        $utc = $this->faker->numberBetween(-100000, 100000);
        $point = Point::factory()->create();
        $creator = Creator::factory()->create();
        $vendor = Vendor::factory()->create();

        $response = $this->put(route('ticket.update', $ticket), [
            'total' => $total,
            'utc' => $utc,
            'point_id' => $point->id,
            'creator_id' => $creator->id,
            'vendor_id' => $vendor->id,
        ]);

        $ticket->refresh();

        $response->assertRedirect(route('ticket.index'));
        $response->assertSessionHas('ticket.id', $ticket->id);

        $this->assertEquals($total, $ticket->total);
        $this->assertEquals($utc, $ticket->utc);
        $this->assertEquals($point->id, $ticket->point_id);
        $this->assertEquals($creator->id, $ticket->creator_id);
        $this->assertEquals($vendor->id, $ticket->vendor_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->delete(route('ticket.destroy', $ticket));

        $response->assertRedirect(route('ticket.index'));

        $this->assertDeleted($ticket);
    }
}
