<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Ticket\Domain\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(
        private TicketService $service
    )
    {}

    /*
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tickets = $this->service->getAll();
        return response()->json($tickets);
    }

    /*
     * @return JsonResponse
     * @param int $id
     */
    public function show(int $id): JsonResponse
    {
        $ticket = $this->service->getOne($id);
        return response()->json($ticket->toArray());
    }

    /*
     * @return JsonResponse
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $ticket = $this->service->create($request->all());
        return response()->json($ticket->toArray(), 201);
    }

    /*
     * @return JsonResponse
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $ticket = $this->service->update($request->all(), $id);
        return response()->json($ticket->toArray());
    }

    /*
     * @return JsonResponse
     * @param int $id
     */
    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}