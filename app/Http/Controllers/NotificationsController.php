<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\Domain\NotificationsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationsController extends Controller
{
   public function __construct(
        private NotificationsService $service
    ) {}

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $notifications = $this->service->getAll();
        return response()->json($notifications->toArray());
    }

    /**
     * @return JsonResponse
     * @param int $id
     */
    public function show(int $id): JsonResponse
    {
        $notification = $this->service->getOne($id);
        return response()->json($notification->toArray());
    }

    /**
     * @return JsonResponse
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $notification = $this->service->create($request->all());
        return response()->json($notification->toArray(), 201);
    }

    /**
     * @return JsonResponse
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $notification = $this->service->update($request->all(), $id);
        return response()->json($notification->toArray());
    }

    /**
     * @return JsonResponse
     * @param int $id
     */
    public function delete(int $id): JsonResponse
    {
        $notification = $this->service->delete($id);
        return response()->json($notification, 204);
    }
}