// routes/api.php
<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/rooms', [RoomController::class, 'index']);
