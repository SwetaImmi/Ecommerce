<?php

namespace App\Exceptions;

use App\Models\DBLog;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    public $filename;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */


     public function report(Throwable $exception)
     {
         if ($this->shouldReport($exception)) {
            
            
            
             // Log exception to database
             DBLog::create([
                 'exception' => $exception->getMessage(),
                 'action' => $exception->getTraceAsString(),
                //  'user_id' => Auth::user()->id,
                 // Add more fields as needed
             ]);
         }
     
         parent::report($exception);
     }

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (TokenInvalidException $e, $request) {
            return Response::json(['error' => 'Invalid token'], 401);
        });
        $this->renderable(function (TokenExpiredException $e, $request) {
            return Response::json(['error' => 'Token has Expired'], 401);
        });

        $this->renderable(function (JWTException $e, $request) {
            return Response::json(['error' => 'Token not parsed'], 401);
        });
    }


    // public function report(Throwable  $exception)
    // {
    //     return 1;
    //     if ($this->shouldReport($exception)) {
    //         return 1;
    //         // Log exception to the database
    //         Log::channel('database')->error($exception);
    //     }

    //     parent::report($exception);
    // }

    // public function render($request, Exception $exception)    {

    //     if ($exception instanceof \App\Exceptions\LogData) {
    //         return 1;
    //         return $exception->render($request, $exception);
    //     }
    //     return 2;
    //     return parent::render($request, $exception);
    // }


    // public function register(): void
    // {
    //     $this->renderable(function (Throwable $e) {
    //         if($e instanceof NotFoundHttpException) {
    //            Log::info('From renderable method: '.$e->getMessage());
    //             // you can return a view, json object, e.t.c
    //             return response()->json([
    //                 'message' => 'From renderable method: Resource not foundss'
    //             ], Response::HTTP_NOT_FOUND);
    //         }

    //         return response()->json([
    //             'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
    //             'message' => $e->getMessage()
    //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     });
    // }

    // public function report(Throwable $e)
    // {
    //     if ($e instanceof NotFoundHttpException) {
    //         Log::info('From report method: ' . $e->getMessage());
    //     }

    //     parent::report($e);
    // }

    // public function render($request, Throwable $e)
    // {
    //     if ($e instanceof NotFoundHttpException) {
    //         return response()->json([
    //             'message' => 'From render method: Resource not found'
    //         ], Response::HTTP_NOT_FOUND);
    //     }

    //     return parent::render($request, $e);
    // }

    // public function render($request, Throwable $e)
    // {
    //     if ($request->is('api/*')) {
    //         return response()->json([
    //             'message' => 'Record not found.'
    //         ], 404);
    //     }
    //     return parent::render($request, $e);
    // }


    // public function render($request, Exception $exception)
    // public function render($request, Exception $exception)    {

    //     if ($exception instanceof \App\Exceptions\LogData) {
    //         return 1;
    //         return $exception->render($request, $exception);
    //     }
    //     return 2;
    //     return parent::render($request, $exception);
    // }

}
