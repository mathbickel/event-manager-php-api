<?php

namespace App\Http\Controllers;

use App\Event\Domain\EventService;
use App\Http\Controllers\Controller;
class EventController extends Controller
{
    public function __construct(
        private EventService $service
    ){}
    
    public function index()
    {
        $events = $this->service->getAll();
        return response()->json($events);
    }

    public function show(int $id)
    {
        $event = $this->service->getOne($id);
        return response()->json($event);
    }

    public function store()
    {
        $event = $this->service->create(request()->all());
        return response()->json($event);
    }

    public function update(int $id)
    {
        $event = $this->service->update(request()->all(), $id);
        return response()->json($event);
    }

    public function delete(int $id)
    {
        $event = $this->service->delete($id);
        return response()->json($event);
    }
}