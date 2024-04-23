<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\IpBlackList;
use Illuminate\Support\Facades\Route;

Route::middleware([IpBlackList::class])->group(function () {
    Route::post('users', [UserController::class, 'store']);
});
