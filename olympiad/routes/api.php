<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Api\CompetitionController;

Route::apiResource('participants', ParticipantController::class);
Route::apiResource('competitions', CompetitionController::class);