<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponses
{


    public static function Error($message = "Error Response Message", $data = null, $statusCode = 500): JsonResponse
    {
        try {

            return response()->json([
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public static function Success($message = "Success Response Message", $data = [], $statusCode = 200): JsonResponse
    {
        try {

            return response()->json([
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

/*  */
