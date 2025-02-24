<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Schedule\Domain\ScheduleService;

class ScheduleController extends Controller 
{
    public function __construct(
        private ScheduleService $service
    )
    {}

    public function index()
    {
        $schedules = $this->service->getAll();
        return response()->json($schedules);
    }

    public function show(int $id)
    {
        $schedule = $this->service->getOne($id);
        return response()->json($schedule->toArray());
    }

    public function store()
    {
        $schedule = $this->service->create(request()->all());
        return response()->json($schedule->toArray(), 201);
    }

    public function update(int $id)
    {
        $schedule = $this->service->update(request()->all(), $id);
        return response()->json($schedule->toArray());
    }

    public function delete(int $id)
    {
        $schedule = $this->service->delete($id);
        return response()->json($schedule, 204);
    }
}