<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Pos\CustomerController;

use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->name('login');








Route::middleware('auth')->group(function (){




 // Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware(['auth'])->name('admin.index');
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');

});





// Customer All Route
Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/all', 'CustomerAll')->name('customer.all');
    Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
    Route::get('/customer/preview/{id}', 'CustomerShow')->name('customer.preview');
    Route::get('/customer/{id}/export-to-excel', 'exportToExcel')->name('export.excel');
    // Route::get('/customer/{id}/export-to-excel', 'exportToExcel')->name('export.excel');
  
Route::get('/customer/print/{id}', 'printInvoice')->name('invoice.print');


    Route::post('/customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
    Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
    Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');

   
   



// Route::post('/add_customer', [CustomerController::class, 'store'])->name('add_customer.store');

});











    


});






/*
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');
*/
require __DIR__.'/auth.php';


// Route::get('/contact', function () {
//     return view('contact');
// });
