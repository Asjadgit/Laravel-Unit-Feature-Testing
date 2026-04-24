<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Asjad\LaravelAI\Facades\AI;
use Illuminate\Support\Facades\Route;


Route::resource('/users',UserController::class);


Route::post('/register',[AuthController::class, 'register'])->name('register');


Route::middleware('authenticate')->group(function() {
    Route::get('/dashboard',function() {
        return 'Dashboard';
    })->name('dashboard');
});

// Route::get('/ai-test', function () {
//     $response = AI::chat([
//         ['role' => 'user', 'content' => 'Say hello in one line']
//     ]);

//     dd($response);
// });

Route::get('/ai-test', function () {
    return AI::chat([
    ['role' => 'user', 'content' => 'Hello']
]);
});


Route::get('/ai-stream', function () {

    return response()->stream(function () {

        AI::stream([
            ['role' => 'user', 'content' => 'Write a short story about AI']
        ], function ($chunk) {
            echo $chunk;
            ob_flush();
            flush();
        });

    }, 200, [
        'Content-Type' => 'text/plain',
        'Cache-Control' => 'no-cache',
    ]);
});
