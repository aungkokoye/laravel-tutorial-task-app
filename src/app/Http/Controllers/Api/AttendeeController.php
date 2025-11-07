<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttendeeController extends BaseController
{
    use CanLoadRelations, AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Attendee::class, 'attendee');

    }

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
    public function destroy(Event $event, Attendee $attendee, Request $request)
    {
        // 2 examples of without authorizeResource in line 20

        // $this->authorize('delete', $attendee);

        // if ($request->user()->cannot('delete', $attendee)) {
        //     abort(403, 'You are not authorized to delete this attendee.');
        // }

        $attendee->delete();

        return response()->json('Attendee deleted successfully');
    }
}
