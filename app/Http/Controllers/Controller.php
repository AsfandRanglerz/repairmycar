<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function data($message, $alert)
    {
        return [
            'message' => $message,
            'alert' => $alert,
        ];
    }

    public function message($variable, $route, $successMessage, $errorMessage)
    {
        if ($variable) {
            return redirect()->route($route)->with(['message' => $successMessage, 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => $errorMessage, 'alert' => 'error']);
        }
    }

    public function jsonMessage($variable, $successMessage, $errorMessage)
    {
        if ($variable) {
            return response()->json(['message' => $successMessage, 'status' => 'success']);
        } else {
            return response()->json(['message' => $errorMessage, 'status' => 'error']);
        }
    }

    function sendSuccess($message, $data = '')
    {
        return Response::json(['status' => 200, 'message' => $message, 'successData' => $data], 200, []);
    }

    function sendError($error_message, $code = 400)
    {
        // session_start();
        $_SESSION["val"]=array();
        $_SESSION["val"]=$error_message;

      return;
    }


}
