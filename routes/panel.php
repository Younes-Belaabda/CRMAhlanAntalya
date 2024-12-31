<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;


Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'LoginController@showLoginForm']);
    Route::post('/', ['as' => 'post', 'uses' => 'LoginController@login']);
});

Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);


Route::group(['prefix' => '/', 'middleware' => ['auth']], function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    
    Route::get('/hotels', ['as' => 'hotels', 'uses' => 'PricesController@print']);
    Route::get('/transfers', ['as' => 'transfers', 'uses' => 'PricesController@print']);
    Route::get('/driver-tours', ['as' => 'driver-tours', 'uses' => 'PricesController@print']);
    
    Route::group(['prefix' => '/agent', 'as' => 'prices.'], function() {
        Route::get('/', ['as' => 'view', 'uses' => 'PricesController@index']);
        Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'PricesController@delete']);
        Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'PricesController@add_new']);
        Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'PricesController@save_new']);
        
        Route::get('/print/{id?}', ['as' => 'print', 'uses' => 'PricesController@print']);
        
        
        Route::group(['prefix' => '/{type_id}/note', 'as' => 'note.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'PricesController@Note']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'PricesController@DeleteNote']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'PricesController@AddNote']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'PricesController@SaveNote']);
        });
        
        Route::group(['prefix' => '/{type_id}/table', 'as' => 'pricestable.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'PricesController@Table']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'PricesController@DeleteTable']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'PricesController@AddTable']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'PricesController@SaveTable']);
            
            Route::group(['prefix' => '/{table_id}/row', 'as' => 'pricesrow.'], function() {
                Route::get('/', ['as' => 'view', 'uses' => 'PricesController@Data']);
                Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'PricesController@DeleteData']);
                Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'PricesController@AddData']);
                Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'PricesController@SaveData']);
            });
        });
    });
    Route::group(['prefix' => '/entries', 'as' => 'movement.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'MovementController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'MovementController@delete']);
            Route::get('/change_status/{id}', ['as' => 'change_status', 'uses' => 'MovementController@change_status']);
            Route::get('/change_statusr/{id}', ['as' => 'change_statusr', 'uses' => 'MovementController@change_statusr']);
            Route::post('/paid', ['as' => 'paid', 'uses' => 'MovementController@paid']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'MovementController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'MovementController@save_new']);
        });
        
    Route::group(['prefix' => '/todolist', 'as' => 'todolist.'], function() {
        Route::get('/', ['as' => 'view', 'uses' => 'ToDoListController@index']);
        Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'ToDoListController@delete']);
        Route::get('/change_status/{id}', ['as' => 'change_status', 'uses' => 'ToDoListController@change_status']);
        Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'ToDoListController@add_new']);
        Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'ToDoListController@save_new']);
        Route::get('/retweet/{id?}', ['as' => 'add_retweet', 'uses' => 'ToDoListController@add_retweet']);
        Route::post('/retweet/{id?}', ['as' => 'save_retweet', 'uses' => 'ToDoListController@save_retweet']);
    });
    
        Route::group(['prefix' => '/voucher', 'as' => 'voucher.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'VoucherController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'VoucherController@delete']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'VoucherController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'VoucherController@save_new']);
            Route::get('/print/{id?}', ['as' => 'print', 'uses' => 'VoucherController@print']);
        });
        Route::group(['prefix' => '/invoice', 'as' => 'invoice.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'InvoiceController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'InvoiceController@delete']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'InvoiceController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'InvoiceController@save_new']);
            Route::get('/print/{id?}', ['as' => 'print', 'uses' => 'InvoiceController@print']);
        });
    Route::group(['middleware' => ['IsAdmin']], function(){
        
        
        Route::group(['prefix' => '/setting', 'as' => 'setting.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'PricesController@setting']);
        });
        Route::group(['prefix' => '/payments', 'as' => 'payments.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'PaymentController@index']);
        });
        Route::group(['prefix' => '/backup', 'as' => 'backup.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'PaymentController@backup']);
            Route::get('/backup', ['as' => 'backup', 'uses' => 'PaymentController@Createbackup']);
            Route::get('/backup/{name}', ['as' => 'download', 'uses' => 'PaymentController@Downloadbackup']);
        });
        Route::group(['prefix' => '/users', 'as' => 'users.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'ManagementController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'ManagementController@delete']);
            Route::get('/change_status/{id}', ['as' => 'change_status', 'uses' => 'ManagementController@change_status']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'ManagementController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'ManagementController@save_new']);
            Route::get('/balance/{id}', ['as' => 'add_balance', 'uses' => 'ManagementController@add_balance']);
            Route::post('/balance/{id}', ['as' => 'save_balance', 'uses' => 'ManagementController@save_balance']);
            Route::delete('/balance_delete/{id}', ['as' => 'balance_delete', 'uses' => 'ManagementController@balance_delete']);
        });
        
        Route::group(['prefix' => '/countries', 'as' => 'countries.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'CountriesController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'CountriesController@delete']);
            Route::get('/change_status/{id}', ['as' => 'change_status', 'uses' => 'CountriesController@change_status']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'CountriesController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'CountriesController@save_new']);
        });

        Route::group(['prefix' => '/cash', 'as' => 'cash.'], function() {
            Route::get('/tax', ['as' => 'tax', 'uses' => 'MovementController@taxs']);
            Route::get('/', ['as' => 'view', 'uses' => 'CashController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'CashController@delete']);
            Route::get('/change_status/{id}', ['as' => 'change_status', 'uses' => 'CashController@change_status']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'CashController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'CashController@save_new']);
        });

        Route::group(['prefix' => '/report', 'as' => 'report.'], function() {
            Route::get('/summary', ['as' => 'summary', 'uses' => 'ReportController@summary']);
            Route::get('/source_service', ['as' => 'source_service', 'uses' => 'ReportController@source_service']);
        });

        Route::group(['prefix' => '/debt', 'as' => 'debt.'], function() {
            Route::get('/', ['as' => 'view', 'uses' => 'DebtController@index']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'DebtController@delete']);
            Route::get('/change_status/{id}', ['as' => 'change_status', 'uses' => 'DebtController@change_status']);
            Route::get('/add/{id?}', ['as' => 'add_new', 'uses' => 'DebtController@add_new']);
            Route::post('/add/{id?}', ['as' => 'save_new', 'uses' => 'DebtController@save_new']);
        });

    });



});
