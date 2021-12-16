<?php

use Imagache\Http\Controllers\ShowImageController;
use Imagache\Http\Controllers\UploadImageController;

Route::post('/upload', UploadImageController::class)->name('upload');
Route::get('/{image}', ShowImageController::class)->name('show');
