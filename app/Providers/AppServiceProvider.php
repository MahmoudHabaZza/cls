<?php

namespace App\Providers;

use App\Http\Responses\CustomPasswordResetLinkSentResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('apiResponse',function($data,$message = "Success",$statusCode = 200) : JsonResponse{
            return response()->json([
                'data' => $data,
                'message' => $message,
            ],$statusCode);
        });
    
        Response::macro('respondCollection',function(string $resourceClass,$collection,$message = "success") : JsonResponse{
            $class = "App\Http\Resources\\".$resourceClass;
            return Response::apiResponse($class::collection($collection),$message);
        });

        Response::macro('respondSingleCollection',function(string $resourceClass,$collection,$message = "success") : JsonResponse{
            $class = "App\Http\Resources\\".$resourceClass;
            return Response::apiResponse(new $class($collection),$message);
        });

        Response::macro('createdResponse',function($resourceClass,$collection) : JsonResponse{
            $class = "App\Http\Resources\\".$resourceClass;
            return Response::apiResponse(new $class($collection),"Created Successfully",201);
        });

        Response::macro('respondNoContent',function($message) : JsonResponse{
            return Response::apiResponse([],$message,204);
        });

        Response::macro('errorResponse',function($errors,$statusCode = 400,$message = "Error") : JsonResponse {
            return Response::apiResponse($errors,$message,$statusCode);
        });
    }
}
