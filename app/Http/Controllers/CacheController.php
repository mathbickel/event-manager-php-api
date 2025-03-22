<?php

namespace App\Http\Controllers;

use App\Common\Cache\CacheService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CacheController extends Controller
{
    public function __construct(
        private CacheService $casheService
    ) 
    {}
    public function invalidateCache(): JsonResponse
    {
        $this->casheService->invalidateCache();
        return response()->json(['message' => 'Cache invalidated successfully.']);
    }
}