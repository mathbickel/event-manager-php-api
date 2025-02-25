<?php

namespace App\Http\Controllers;

use App\Attendee\Domain\AttendeeService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AttendeeController extends Controller 
{
    public function __construct(
        private AttendeeService $service
    ) {}

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $attendees = $this->service->getAll();
        return response()->json($attendees);
    }

    /**
     * @return JsonResponse
     * @param int $id
     */
    public function show(int $id): JsonResponse
    {
        $attendee = $this->service->getOne($id);
        return response()->json($attendee->toArray());
    }

    /**
     * @return JsonResponse
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $attendee = $this->service->create($request->all());
        return response()->json($attendee->toArray(), 201);
    }

    /**
     * @return JsonResponse
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $attendee = $this->service->update($request->all(), $id);
        return response()->json($attendee->toArray());
    }

    /**
     * @return JsonResponse
     * @param int $id
     */
    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}