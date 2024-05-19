<?php

use App\Http\Controllers\API\Central\V1\AccountController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::prefix('v1')->group(function () {
            /**
             * Tài khoản
             */
            Route::prefix('accounts')->group(function () {
                // Tạo tài khoản mới
                Route::post('create', [AccountController::class, 'create']);
                // Đăng nhập tài khoản
                Route::post('login', [AccountController::class, 'login']);
                // Đăng xuất tài khoản
                Route::delete('logout', [AccountController::class, 'logout'])->middleware('auth');
            });
        });
    });
}
