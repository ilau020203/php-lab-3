<?php

namespace App\Exceptions;

use App\Http\Api\v1\Helpers\Resources\EmptyResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TypeError;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param \Request $request
     * @param Throwable $ext
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof NotFoundHttpException)
    //     {
    //         return response()->json(new ErrorPathResource($request), 404);
    //     }

    //     if ($request->is('api/v1/*')) {
    //         if ($exception instanceof ModelNotFoundException) {
    //             EmptyResourceController::$code = 404;
    //             EmptyResourceController::$message = $exception->getMessage();
    //             return response()->json(new EmptyResource($request), 404);
    //         }
    //         if ($exception instanceof ValidationException || $exception instanceof TypeError) {
    //             EmptyResourceController::$code = 400;
    //             EmptyResourceController::$message = $exception->getMessage();
    //             return response()->json(new EmptyResource($request), 400);
    //         }

    //         EmptyResourceController::$code = 500;
    //         EmptyResourceController::$message = $exception->getMessage();
    //         return response()->json(new EmptyResource($request), 500);
    //     }

    //     return parent::render($request, $exception);
    // }

    /**
     * @param \Request $request
     * @param Throwable $ext
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $ext)
    {
        if ($ext instanceof ValidationException) {
            return response()->json(
                [
                    'data' => [

                    ],
                    'errors' => [[
                        "code"=>400,
                        "message"=> "{$ext->getMessage()}",
                        "meta"=>[]
                    ]],
                "meta"=> []
              ],
                400
            );
        }

        return parent::render($request, $ext);
    }

}
