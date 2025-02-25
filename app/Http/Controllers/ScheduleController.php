<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Schedule\Domain\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller 
{
    public function __construct(
        private ScheduleService $service
    )
    {}

    /**
     * @return JsonResponse
    */
    public function index(): JsonResponse
    {
        $schedules = $this->service->getAll();
        return response()->json($schedules);
    }

    /**
     * @return JsonResponse
     * @param int $id
    */
    public function show(int $id): JsonResponse
    {
        $schedule = $this->service->getOne($id);
        return response()->json($schedule->toArray());
    }

    /**
     * @return JsonResponse
     * @param Request $request
    */
    public function store(Request $request): JsonResponse
    {
        $schedule = $this->service->create($request->all());
        return response()->json($schedule->toArray(), 201);
    }

    /**
     * @return JsonResponse
     * @param Request $request
     * @param int $id
    */
    public function update(Request $request, int $id): JsonResponse
    {
        $schedule = $this->service->update($request->all(), $id);
        return response()->json($schedule->toArray());
    }

    /**
     * @return JsonResponse
     * @param int $id
    */
    public function delete(int $id): JsonResponse
    {
        $schedule = $this->service->delete($id);
        return response()->json($schedule, 204);
    }
}