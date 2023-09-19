<?php

use App\Http\Controllers\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('storeUrl', [LinkController::class, 'store']);
Route::get('displayUrls/{user_id}', [LinkController::class, 'index']);
Route::delete('deleteUrls/{url_id}', [LinkController::class, 'destroy']);
Route::get('mostVisitedUrls/{user_id}', [LinkController::class, 'mostVisited']);
Route::get('totalVisits/{user_id}', [LinkController::class, 'totalVisits']);


