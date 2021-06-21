<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response(int $httpCode, bool $success, string $message, int $code, $data) {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ],$httpCode);
    }

    public function responseSuccess( $data = null) {
        return $this->response(200, true, 'success', 200, $data );
    }

    public function responseFail( $message = null, $code = 500) {
        return $this->response(500, false, $message, $code, null );
    }

    public function responseBadRequest( string $message = null ) {
        return response()->json([
            'success' => false,
            'message'=>$message,
            'code'=> 400,
        ],400);
    }
}
