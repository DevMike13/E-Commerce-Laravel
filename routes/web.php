<?php

use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\SuccessPage;
use Filament\Pages\Auth\Register;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomePage::class)->name('user.home');
Route::get('/cart', HomePage::class);
Route::get('/products', HomePage::class);
Route::get('/details', HomePage::class);

Route::middleware('guest')->group(function () {
    // AUTH
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware('auth')->group(function (){
    Route::get('/logout', function (){
        auth()->logout();
        return redirect('/');
    });
    Route::get('/checkout', HomePage::class);
    Route::get('/my-orders', MyOrdersPage::class);
    Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('my-orders.show');
    
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});