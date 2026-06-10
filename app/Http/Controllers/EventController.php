<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    private EventService $eventService;
    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }
    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return View::make('events.index', ['events' => $events]);
    }

    public function create()
    {
//        $this->authorize('create', Event::class);
        return View::make('events.create');
    }

    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        $this->eventService->createEvent($validated);
        return Redirect::route('events.index')->with('success', '');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = $this->eventService->getEventById($id);
        return view('events.edit', ['event' => $event]);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = $this->eventService->getEventById($id);
        $validated = $request->validated();
        $this->eventService->updateEvent($event, $validated);
        return Redirect::route('events.index')->with('success', '');
    }

    public function destroy($id, AttachmentService $attachmentService)
    {
        $event = Event::findOrFail($id);
        $attachmentService->deleteAllEventAttachments($event);

        $this->eventService->deleteEvent($event);

        return Redirect::route('events.index')->with('success', 'Событие и все вложения удалены');
    }


}
