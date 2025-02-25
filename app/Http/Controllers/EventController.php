<?php

namespace App\Http\Controllers;

use App\Event\Domain\EventService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function __construct(
        private EventService $service
    ){}
    
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $events = $this->service->getAll();
        return response()->json($events);
    }

    /**
     * @return JsonResponse
     * @param int $id
     */
    public function show(int $id): JsonResponse
    {
        $event = $this->service->getOne($id);
        return response()->json($event->toArray()); 
    }

    /**
     * @return JsonResponse
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $event = $this->service->create($request->all());
        return response()->json($event->toArray(), 201);
    }

    /**
     * @return JsonResponse
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $event = $this->service->update($request->all(), $id);
        return response()->json($event->toArray());
    }

    /**
     * @return JsonResponse
     * @param int $id
     */
    public function delete(int $id): JsonResponse
    {
        $event = $this->service->delete($id);
        return response()->json($event, 204);
    }
}