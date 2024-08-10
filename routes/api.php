<?php

use App\Livewire\HomePage;
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

Route::get('/twilio/token', [HomePage::class, 'generateToken']);
Route::post('/twilio/voice', [HomePage::class, 'twilioResponse']);
Route::post('/twilio/status', [HomePage::class, 'statusCallback']);
// Route::post('/twilio/call', [HomePage::class, 'makeCall'])->name('twilio.make-call');