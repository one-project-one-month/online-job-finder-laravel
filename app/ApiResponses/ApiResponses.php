<?php

namespace App\ApiResponses;

Trait ApiResponses
{
    public static function successResponse($message, $status = null, $data = null, $code = 200)
    {
        $response = [
            'message' => $message
        ];

        if($status !== null)
        {
            $response['status'] = $status;
        }

        if($data !== null)
        {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    public static function errorResponse($message, $status, $code)
    {
        $response = [
            'message' => $message
        ];

        if($status !== null)
        {
            $response['status'] = $status;
        }

        return response()->json($response, $code);
    }
}
