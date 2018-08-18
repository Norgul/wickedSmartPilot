<?php

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
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paper-work-document/{document}', function ($document) {
    $documentPath = 'invoices/paperwork/' . $document;

    if (Storage::disk('local')->exists($documentPath)) {
        return Storage::disk('local')->response($documentPath);
    } else {
        return Storage::disk('local')->response('invoices/paperwork/example-document-1.pdf');
    }
})->name('paperwork.pdf');

Route::get('/verify-account/{signature}/{user}', 'Auth\MailVerificationController@verify')->name('verify.email');

Route::redirect('/dashboard', '/', 301)->name('dashboard');
Route::redirect('/profile', '/', 301)->name('profile');

Route::post('/invoices', 'InvoicesController@fetch')->name('invoices.fetch');
Route::post('/invoices/change-status', 'InvoicesController@updateStatus')->name('invoices.status');
