<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // do not call from $request, $this is the model instance
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'user'          => UserResource::make($this->whenLoaded('user')), // same as new UserResource(...)
            'attendees'     => AttendeeResource::collection($this->whenLoaded('attendees')),
        ];
    }
}
