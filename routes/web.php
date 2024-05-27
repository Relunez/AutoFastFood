<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/', function () {
        $path = public_path('swagger/index.html');

        if (!File::exists($path)) {
            abort(404);
        }

        return File::get($path);
    });
});

