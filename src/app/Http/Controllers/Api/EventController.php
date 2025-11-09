<?php
namespace App\Http\Controllers\Api;


use App\Notifications\EventCreateNotification;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends BaseController
{
    use CanLoadRelations;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('throttle:3, 1')->only(['store', 'update', 'destroy']);
    }

    private array $relations = ['user', 'attendees'];

    public function index()
    {
        $builder = $this->loadRelations(Event::query());
        return EventResource::collection($builder->latest()->paginate(10));
    }

    public function store(EventRequest $request)
    {
        $event = $request->validated();
        $event = Event::create([
            ...$event,
            'user_id' => request()->user()->id,
        ]);

        $event->user->notify(new EventCreateNotification($event));

        return new EventResource($event);
    }

    public function show(Event $event)
    {
        return new EventResource($this->loadRelations($event));
    }

    public function update(Request $request, Event $event)
    {
        Gate::authorize('update-event', $event);

        $event->update($request->validate([
            'name'          => 'sometimes|string|max:255', // removed 'required' to make it optional
            'description'   => 'nullable|string',
            'start_time'    => 'sometimes|date',
            'end_time'      => 'sometimes|date|after:start_time'
            ])
        );

        return EventResource::make($event);
    }

    public function destroy(Event $event)
    {
        if (Gate::denies('delete-event', $event)) {
            abort(403, 'You are not authorized to delete this event.');
        }

        $event->delete();
        // return response(status: 204);
        return response()->noContent();
    }
}
