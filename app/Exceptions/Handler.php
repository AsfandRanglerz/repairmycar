<?php

namespace App\Exceptions;

//use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            $message = [
                'message' => 'You do not have the required authorization!',
                'alert' => 'error',
            ];
            if (Auth::guard('admin')->check() && $request()->routeIs('admin/*')) {
                return redirect()->route('admin.login')->with($message);
            }
            if (Auth::guard('vendor')->check() && $request()->routeIs('vendor/*')) {
                return redirect()->route('vendor.login')->with($message);
            }
            if (Auth::guard('web')->check() && $request()->routeIs('user/*')) {
                return redirect()->route('login')->with($message);
            }

            return Response::json([
                'status' => 403,
                'message' => 'You do not have the required authorization!',
            ]);
        });
    }

//    protected function unauthenticated($request, AuthenticationException $exception)
//    {
//        if ($request->expectsJson()) {
//            $json = [
//                'isAuth'=>false,
//                'message' => $exception->getMessage()
//            ];
//            return response()
//                ->json($json, 401);
//        }
//        $guard = array_get($exception->guards(),0);
//        switch ($guard) {
//            default:
//                $login = 'login';
//                break;
//        }
//        return redirect()->guest(route($login));
//    }

}
