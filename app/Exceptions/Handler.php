<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Les types d’exceptions qui ne doivent pas être rapportés.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Les entrées qui ne doivent pas être flashées dans la session lors d’une validation d’erreur.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Rapport ou log l’exception.
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Convertit une exception en réponse HTTP.
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
