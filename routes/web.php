<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if(env('APP_ENV') == 'developement'){
    Route::get('demo-login' , function(){
        $email = 'abdalbari.taleb@gmail.com';
        $user = \App\User::where('email', '=', $email)->first();
        Auth::loginUsingId($user->id);
        return redirect()->route('login');
    })->name('demo-login');
}


Route::get('/', 'LoginController@showLoginForm')->name('login');
Route::post('/','LoginController@login')->name('Plogin');
Route::get('/login', 'LoginController@showLoginForm')->name('logins');
Route::post('/login','LoginController@login')->name('Plogins');


Route::group(['prefix' => '/payments', 'as' => 'payments.'], function() {
    Route::get('/{type}/{price}', ['as' => 'view', 'uses' => 'PaymentController@index']);
    Route::post('/{type}/{price}', ['as' => 'paid', 'uses' => 'PaymentController@paid']);
    Route::get('/pay', ['as' => 'pay', 'uses' => 'PaymentController@newPay']);
    Route::post('/pay', ['as' => 'pay', 'uses' => 'PaymentController@newPay']);
});




// // Show payment form
// Route::get('/payments/{type}/{price}', [PaymentController::class, 'index'])->name('payment.form');

// // Process initial payment (3D Secure initiation)
// Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');

// // Handle callback after 3D Secure verification
// Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

// Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
// Route::post('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
