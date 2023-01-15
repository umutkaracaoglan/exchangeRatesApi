<?php

namespace App\Traits;

trait ApiResponse
{
    protected function success(array $data, mixed $message = null, int $code = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    protected function error(int $code, mixed $message = null)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => null
        ], $code);
    }
}
