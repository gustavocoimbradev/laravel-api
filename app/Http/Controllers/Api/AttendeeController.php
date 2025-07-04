<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AttendeeController extends Controller
{
 
    public function index(Event $event)
    {
        $attendees = $event->attendees()->latest();
        return AttendeeResource::collection($attendees->paginate());
    }

    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);
        return new AttendeeResource($attendee);
    }


    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    public function destroy(Event $event, Attendee $attendee)
    {

        if(Gate::denies('delete-attendee', [$event, $attendee])) {
            abort(403, 'You are not authorized to delete this attendee.');
        }

        $attendee->delete();
        return response('status', 204);
    }
}
