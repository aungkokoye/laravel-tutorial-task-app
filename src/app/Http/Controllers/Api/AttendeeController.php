<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRelations;

    private array $relations = ['user'];

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $attendees = $this->loadRelations($event->attendees())->latest();
        return AttendeeResource::collection($attendees->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Event $event, Request $request)
    {
        $attendee = $event->attendees()->create([
            'user_id'  => rand(10, 100),
            'event_id' => $event->id,
        ]);
        $attendee = $this->loadRelations($attendee);

        return AttendeeResource::make($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        $attendee = $this->loadRelations($attendee);
        // prevent extra query to load event if you need it in the resource
        // $attendee->setRelation('event', $event);
        return AttendeeResource::make($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        $attendee->delete();

        return response()->json('Attendee deleted successfully');
    }
}
