<?php

    use App\Http\Controllers\Api\Auth\AuthController;
    use App\Http\Controllers\Api\MediaController;
    use App\Http\Controllers\Api\NewsController;
    use App\Http\Controllers\Api\PostController;
    use App\Http\Controllers\Api\UserController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::group( [ 'as' => 'api.' ] , function () {

        Route::post( '/register' , [ AuthController::class , 'register' ] )->name( 'register' )->middleware("throttle:60,1");
        Route::post( '/login' , [ AuthController::class , 'login' ] )->name( 'login' )->middleware("throttle:60,1");
        Route::post( '/check/code' , [ AuthController::class , 'checkCode' ] )->name( 'check.code' )->middleware("throttle:60,1");

        Route::group( [ 'prefix' => 'user' ] , function () {
            Route::get( '/' , [ UserController::class , 'index' ] )->name( 'user' );
            Route::get( '/show/{id}' , [ UserController::class , 'show' ] )->name( 'user.show' );
            Route::get( '/delete/{id}' , [ UserController::class , 'delete' ] )->name( 'user.delete' );
        } );

        Route::group( [ 'prefix' => 'post' ] , function () {
            Route::get( '/' , [ PostController::class , 'index' ] )->name( 'post' );
            Route::get( '/show/{id}' , [ PostController::class , 'show' ] )->name( 'post.show' );
            Route::post( '/create' , [ PostController::class , 'create' ] )->name( 'post.create' );
            Route::post( '/update/{id}' , [ PostController::class , 'update' ] )->name( 'post.update' );
            Route::get( '/delete/{id}' , [ PostController::class , 'delete' ] )->name( 'post.delete' );
        } );

        Route::group( [ 'prefix' => 'news' ] , function () {
            Route::get( '/' , [ NewsController::class , 'index' ] )->name( 'news' );
            Route::get( '/show/{id}' , [ NewsController::class , 'show' ] )->name( 'news.show' );
            Route::post( '/create' , [ NewsController::class , 'create' ] )->name( 'news.create' );
            Route::post( '/update/{id}' , [ NewsController::class , 'update' ] )->name( 'news.update' );
            Route::get( '/delete/{id}' , [ NewsController::class , 'delete' ] )->name( 'news.delete' );
        } );

        Route::group( [ 'prefix' => 'media' ] , function () {
            Route::get( '/' , [ MediaController::class , 'index' ] )->name( 'media' );
            Route::get( '/show/{id}' , [ MediaController::class , 'show' ] )->name( 'media.show' );
            Route::post( '/create' , [ MediaController::class , 'create' ] )->name( 'media.create' );
            Route::post( '/create/multiple' , [ MediaController::class , 'createMultiple' ] )->name( 'media.create.multiple' );
            Route::get( '/delete/{id}' , [ MediaController::class , 'delete' ] )->name( 'media.delete' );
        } );

    } );

