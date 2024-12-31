<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        function response_api($status, $message, $items = null)
        {
            $response = ['status' => $status, 'message' => $message];
            if ($status && isset($items)) {
                $response['item'] = $items;
            } else {
                $response['errors_object'] = $items;
            }
            return response()->json($response);
        }

        Static function sendResponse($result, $message)
        {
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message,
            ];

            return response()->json($response, 200);
        }

        Static function sendError($error, $errorMessages = [], $code = 404)
        {
            $response = [
                'success' => false,
                'message' => $error,
            ];

            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }

            return response()->json($response, $code);
        }
        
}
