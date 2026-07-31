<?php

use App\Http\Controllers\HorarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/listarHorarios", [HorarioController::class, "index"]);
Route::post("/crearHorarios", [HorarioController::class, "create"]);
Route::delete("/eliminarHorarios", [HorarioController::class, "destroy"]);
