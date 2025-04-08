<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Exception;

trait ApiResponseTrait
{
    /**
     * Success Response
     */
    protected function successResponse($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Error Response
     */
    protected function errorResponse(string $message, int $code = 400, $errors = null): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    /**
     * Handle Validation Exception
     */
    protected function handleValidationException(ValidationException $e): JsonResponse
    {
        return $this->errorResponse(
            'Validation failed',
            422,
            $e->validator->errors()->toArray()
        );
    }

    /**
     * Handle Not Found Exception
     */
    protected function handleNotFoundException(string $resource = 'Resource'): JsonResponse
    {
        return $this->errorResponse(
            "{$resource} not found",
            404
        );
    }

    /**
     * Handle General Exception
     */
    protected function handleException(Exception $e, string $message = 'An error occurred'): JsonResponse
    {
        return $this->errorResponse(
            $message,
            500,
            [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]
        );
    }
}
