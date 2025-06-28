<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('login');
});

Route::post('/register-pelajar', [App\Http\Controllers\DaftarController::class, 'register']);

Route::get('/daftar', function () {
    return view('daftar');
});

Route::post('/daftar', [App\Http\Controllers\DaftarController::class, 'register']);

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

Route::get('/toyyibpay/callback', [App\Http\Controllers\AuthController::class, 'toyyibpayCallback'])->name('toyyibpay.callback');
Route::get('/bayar/{bill_code}', [App\Http\Controllers\AuthController::class, 'billPaymentLink'])->name('toyyibpay.bayar');
Route::get('/transaction/{transaction}/receipt', [TransactionController::class, 'downloadReceipt'])
    ->middleware('auth')
    ->name('transaction.receipt');

// Route untuk generate PDF resit
Route::get('/transaction/{id}/pdf', [TransactionController::class, 'generateReceipt'])
    ->middleware('auth')
    ->name('transaction.pdf');

// Route test untuk debug PDF (temporary)
Route::get('/test-pdf/{id}', [TransactionController::class, 'generateReceipt'])->name('test.pdf');


// qr
Route::get('/pelajar/{pelajar}/qr', [QRCodeController::class, 'showQrCode'])->name('pelajar.qr');
Route::get('/scan-qr', [QRCodeController::class, 'scanQrPage'])->name('scan.qr');
Route::post('/get-pelajar', [QRCodeController::class, 'getPelajarData'])->name('get.pelajar');