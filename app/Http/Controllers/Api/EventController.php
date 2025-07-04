<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    public function index()
    {
        $query = Event::query();
        $relations = ['user', 'attendees', 'attendees.user'];

        foreach ($relations as $relation) {
            $query->when(
                $this->helperShouldIncludeRelation($relation),
                fn($q) => $q->with($relation)
            );
        }

        return EventResource::collection(
            $query->latest()->paginate()
        );
    }

    protected function helperShouldIncludeRelation(string $relation): bool {
        $include = request()->query('include');
        if (!$include) {
            return false;
        }
        $relations = array_map('trim', explode(',', $include));
        return in_array($relation, $relations);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'start_time'    => 'required|date',
            'end_time'      => 'required|date|after:start_time'
        ]);

        $data['user_id'] = $request->user()->id;

        $event = Event::create($data);

        return new EventResource($event);
    }

    public function show(Event $event)
    {
        $event->load('user')->load('attendees');
        return new EventResource($event);
    }


    public function update(Request $request, Event $event)
    {

        if (Gate::denies('update-event', $event)) {
            abort(403, 'You are not authorized to update this event.');
        } 
        
        $data = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'description'   => 'nullable|string',
            'start_time'    => 'sometimes|date',
            'end_time'      => 'sometimes|date|after:start_time'
        ]);

        $event->update($data);

        return new EventResource($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response(status: 204);
    }
}
