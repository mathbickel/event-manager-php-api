<?php

namespace App\Http\Controllers;

use App\Attendee\Domain\AttendeeService;
use App\Http\Controllers\Controller;


class AttendeeController extends Controller 
{
    public function __construct(
        private AttendeeService $service
    ) {}
    public function index() {
        $attendees = $this->service->getAll();
        return response()->json($attendees);
    }

    public function show(int $id) {
        $attendee = $this->service->getOne($id);
        return response()->json($attendee->toArray());
    }

    public function store() {
        $attendee = $this->service->create(request()->all());
        return response()->json($attendee->toArray(), 201);
    }

    public function update(int $id) {
        $attendee = $this->service->update(request()->all(), $id);
        return response()->json($attendee->toArray());
    }

    public function delete(int $id) {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}