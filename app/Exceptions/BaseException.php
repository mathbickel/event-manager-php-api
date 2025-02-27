<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseException extends Exception
{
    /**
     * @param int $statusCode
     * @param array $data
     */
    public function __construct(
        string $message = 'An error occurred',
        protected int $statusCode = 500, 
        protected array $data = [])
    {
        parent::__construct($message, $statusCode);
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'data' => $this->data,
        ], $this->statusCode);
    }
}