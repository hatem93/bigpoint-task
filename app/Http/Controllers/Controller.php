<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;
use App\Helpers\ResponseObject;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function handleResponse($data)
    {
        $response = new ResponseObject();
        $response->Object = $data;
        $response->status_code = 200;
        return Response::json($response,$response->status_code);
    }

    public function handleValidationError($data)
    {
        $response = new ResponseObject();
        $response->errorMessage = $data;
        $response->status_code = \Illuminate\Http\Response::HTTP_BAD_REQUEST;
        return Response::json($response,$response->status_code);
    }

}
