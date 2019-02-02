<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Helpers\ResponseObject;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return $this->handleException($exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }

    public function handleException($exception){
        $response = new ResponseObject();
        if($exception instanceof BadRequestException){

            $response->errorMessage = $exception->getBadRequestMassege();
            $response->status_code = \Illuminate\Http\Response::HTTP_BAD_REQUEST;
        }
        elseif ($exception instanceof InternalErrorException) {
            $response->errorMessage = $exception->getInternalErrorMessage();
            $response->status_code = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        elseif ($exception instanceof UnauthorizedException) {
            $response->errorMessage = $exception->getUnauthorizedMessage();
            $response->status_code = \Illuminate\Http\Response::HTTP_UNAUTHORIZED;
        }
        elseif ($exception instanceof CustomException) {
            $response->errorMessage = $exception->getCustomMassege();
            $response->status_code = $exception->getStatusCode();
        }
        elseif ($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            $response->errorMessage = $exception->getMessage();
            $response->status_code = 440;
        }
        elseif ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            $response->errorMessage = $exception->getMessage();
            $response->status_code = 441;
        }
        elseif ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            $response->errorMessage = $exception->getMessage();
            $response->status_code = 442;
        }
        else
        {
            $response->errorMessage = $exception->getMessage();
            $response->status_code = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $response->errored = true;
        return Response::json($response,$response->status_code);

    }
}
