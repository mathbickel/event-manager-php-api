<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\Domain\NotificationsService;

class NotificationsController extends Controller
{
   public function __construct(
        private NotificationsService $service
    ) {}

    public function index()
    {
        $notifications = $this->service->getAll();
        return response()->json($notifications->toArray());
    }

    public function show(int $id)
    {
        $notification = $this->service->getOne($id);
        return response()->json($notification->toArray());
    }

    public function store()
    {
        $notification = $this->service->create(request()->all());
        return response()->json($notification->toArray(), 201);
    }

    public function update(int $id)
    {
        $notification = $this->service->update(request()->all(), $id);
        return response()->json($notification->toArray());
    }

    public function delete(int $id)
    {
        $notification = $this->service->delete($id);
        return response()->json($notification, 204);
    }
}