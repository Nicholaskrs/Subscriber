<?php

namespace App\Helper;

class ResponseHelper
{
    public static function responseOK($data, $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "data" => $data,
            "status" => $status,
            "message" => "OK"
        ], $status);
    }

    public static function responseDataAlreadyExists(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
                "data" => [],
                "status" => 422,
                "message"=>"Data Already Exists"
            ],422);
    }
}
