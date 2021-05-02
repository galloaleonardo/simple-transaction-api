<?php


namespace App\Http\Controllers;

use \Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function sendSuccessfulResponse(
        $result,
        $code = 200,
        $message = 'Request received successfully.'
    ): JsonResponse {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendErrorResponse(
        $error,
        $errorMessages = [],
        $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
