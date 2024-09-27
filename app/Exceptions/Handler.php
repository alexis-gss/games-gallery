<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [];

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
     * Change the path of the render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable               $exception
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Throwable If errors.
     * @phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function render($request, Throwable $exception): \Symfony\Component\HttpFoundation\Response
    {
        // phpcs:enable
        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
            return response()->make(view("errors.pages.{$statusCode}"), $statusCode);
        }
        return parent::render($request, $exception);
    }
}
