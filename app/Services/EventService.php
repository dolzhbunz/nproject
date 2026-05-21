<?php

namespace App\Services;
use App\Models\Event;

class EventService
{
    public function getAllEvents()
    {
        return Event::paginate(2);
    }

    public function getEventById($id)
    {
        return Event::findOrFail($id);
    }
    public function createEvent(array $data)
    {
        try{
            return Event::create($data);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function updateEvent(Event $event, array $data)
    {
        try {
            $event->update($data);
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function deleteEvent(Event $event, array $data) // лишний параметр $data
    {
        $event->delete($data); // delete() не принимает аргументы
    }



}
