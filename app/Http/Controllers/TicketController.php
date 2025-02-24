<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class TicketController extends Controller
{
    public function __construct(
        private TicketService $service
    )
    {}

    public function index()
    {
        $tickets = $this->service->getAll();
        return response()->json($tickets);
    }

    public function show(int $id)
    {
        $ticket = $this->service->getOne($id);
        return response()->json($ticket->toArray());
    }

    public function store()
    {
        $ticket = $this->service->create(request()->all());
        return response()->json($ticket->toArray(), 201);
    }

    public function update(int $id)
    {
        $ticket = $this->service->update(request()->all(), $id);
        return response()->json($ticket->toArray());
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}