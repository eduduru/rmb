<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentsController;
use App\Models\Payments;
use App\Models\Rawlogs;
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



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('blogs', PaymentsController::class);

Route::post('api/payments', [PaymentsController::class, 'transfers']);

// Route::post('/payments', 'PaymentsController@transfers');
