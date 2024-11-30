<?php


namespace App\Helpers;

class ResponseHelper
{
    public static function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'statusCode' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public static function error($data, $message = null, $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'statusCode' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function validation($data, $message = null, $code = 400)
    {
        return response()->json([
            'status' => 'validation_error',
            'statusCode' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function unauthorized($data, $message = null, $code = 401)
    {
        return response()->json([
            'status' => 'unauthorized',
            'statusCode' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public static function paginated($paginator, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'statusCode' => $code,
            'message' => $message,
            'data' => $paginator->items(),
            'meta' => [
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'total' => $paginator->total(),
                'lastPage' => $paginator->lastPage(),

            ]
        ], $code);
    }
}
