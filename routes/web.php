<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = User::find(1);
    $user->courses()->attach([1,2,3]);


    // return $user->courses;
});
