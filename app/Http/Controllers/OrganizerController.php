<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Organizer\Domain\OrganizerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizerController extends Controller 
{
    public function __construct(
        protected OrganizerService $service
    ){}

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $organizers = $this->service->getAll();
        return response()->json($organizers->toArray());
    }

    /**     
     * @return JsonResponse
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $organizer = $this->service->create($data);
        return response()->json($organizer->toArray(), 201);
    }

    /**     
     * @return JsonResponse
     * @param int $id
     */
    public function show(int $id): JsonResponse
    {
        $organizer = $this->service->getOne($id);
        return response()->json($organizer);
    }

    /**     
     * @return JsonResponse
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->all();
        $organizer = $this->service->update($data, $id);
        return response()->json($organizer);
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