<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;

class RegisterController extends Controller
{
    public function store(Request $request,
                          CreatesNewUsers $creator): LoginResponse
    {
        if (config('fortify.lowercase_usernames') && $request->has(Fortify::username())) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        event(new Registered($user = $creator->create($request->all())));
        // $request object is singleton object 
        // you can append anything to it through the application
        $request->request->add(['user' => $user]);
        return app(LoginResponse::class);
    }
}


