<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Mail\ExceptionOccured;
use Symfony\Component\Console\Helper\SymfonyQuestionHelper;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if($this->shouldReport($exception)){
            $this->sendMail($exception);
        }
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
        if($exception instanceof \Illuminate\Validation\ValidationException) {
            if ($request->expectsJson()) {
                return response('Sorry, validation failed.', 422);
            }
        }

        if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('home');
        }
        if ($exception instanceof \ThrottleException) {
            return response($exception->getMessage(), 429);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('admin/login');
        }
        return redirect()->guest(route('login'));
    }

    public function sendMail(Exception $exception){
        try {
            $e = FlattenException::create($exception);
            $handler = new SymfonyExceptionHandler();
            $html = $handler->getHtml($e);
            Mail::to('meocom10@gmail.com')->send(new ExceptionOccured($html));
        } catch (\Throwable $e) {
            //throw $th;
        }
    }
}
