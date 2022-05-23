<?php
use Illuminate\Support\Facades\Route;
use JSCustom\LaravelUserManagement\Http\Controllers\User\UserController;
use JSCustom\LaravelUserManagement\Http\Controllers\UserRole\UserRoleController;
use JSCustom\LaravelUserManagement\Providers\AuthServiceProvider;

if (config('user.sanctum.enabled')) {
    Route::group(['middleware' => [
        'auth:sanctum',
        'ability:'.implode(',', AuthServiceProvider::USER_MANAGEMENT_ABILITIES)
        ]
    ], function() {
        Route::group(['prefix' => 'user'], function() {
            Route::post('', [UserController::class, 'store']);
            Route::post('/{id}', [UserController::class, 'edit']);
            Route::get('/list', [UserController::class, 'list']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });
        Route::group(['prefix' => 'user-role'], function() {
            Route::post('', [UserRoleController::class, 'store']);
            Route::post('/{id}', [UserRoleController::class, 'edit']);
            Route::get('/list', [UserRoleController::class, 'list']);
            Route::get('/{id}', [UserRoleController::class, 'show']);
            Route::delete('/{id}', [UserRoleController::class, 'destroy']);
        });
    });
} else {
    Route::group(['prefix' => 'user'], function() {
        Route::post('', [UserController::class, 'store']);
        Route::post('/{id}', [UserController::class, 'edit']);
        Route::get('/list', [UserController::class, 'list']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::group(['prefix' => 'user-role'], function() {
        Route::post('', [UserRoleController::class, 'store']);
        Route::post('/{id}', [UserRoleController::class, 'edit']);
        Route::get('/list', [UserRoleController::class, 'list']);
        Route::get('/{id}', [UserRoleController::class, 'show']);
        Route::delete('/{id}', [UserRoleController::class, 'destroy']);
    });
}
?>