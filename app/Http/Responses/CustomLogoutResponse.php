<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Fortify\Contracts\LogoutResponse;

class CustomLogoutResponse implements LogoutResponse {
    public function toResponse($request)
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return Response::apiResponse([],"Logged Out Successfully!",200);
    }
}