<?php

namespace App\Services;

class ResponseService
{
    public function success($message, $data = [])
    {
        return response()->json([
            'statusCode' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function created($message, $data = [])
    {
        return response()->json([
            'statusCode' => 201,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function badRequest($message, $th = null)
    {
        return response()->json([
            'statusCode' => 400,
            'message' => $message,
            'log' => [
                'message' => isset($th) ? $th->getMessage() : null,
                'file' => isset($th) ? $th->getFile() : null,
                'line' => isset($th) ? $th->getLine() : null
            ]
        ]);
    }

    public function anauthorized()
    {
        return response()->json([
            'statusCode' => 401,
            'message' => 'Usuário não autorizado',
        ]);
    }

    public function notAcceptable()
    {
        return response()->json([
            'statusCode' => 406,
            'message' => 'Usuário não foi encontrado'
        ]);
    }
}