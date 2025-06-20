<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LocaleMiddleware;
use App\Http\Middleware\SessionTimeoutMiddleware;
use App\Schedule\SendDailyTopicSchedule;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(LocaleMiddleware::class);
        $middleware->web(SessionTimeoutMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    // ->withSchedule(function (Schedule $schedule) {
    //     (new SendDailyTopicSchedule())->__invoke($schedule);
    // })
    ->create();

