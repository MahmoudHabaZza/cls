<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function(UnauthorizedException $e){
            return Response::errorResponse($e->getMessage(),401);
        });
        $exceptions->renderable(function(ModelNotFoundException $e){
            return Response::errorResponse("Resource Not Found",404);
        });
        $exceptions->renderable(function(InvalidArgumentException $e){
            return Response::errorResponse($e->getMessage(),422);
        });
        $exceptions->renderable(function(ValidationException $e){
            return Response::errorResponse($e->getMessage(),422);
        });
        $exceptions->renderable(function(QueryException $e){
            if(str_contains($e->getMessage(),'Duplicate Entry')){
                return Response::errorResponse('Resource Already Exists',409);
            };
            return Response::errorResponse($e->getMessage(),500);
        });
        $exceptions->renderable(function(Throwable $th){
            return Response::errorResponse($th->getMessage(),500);
        });
    })->create();
