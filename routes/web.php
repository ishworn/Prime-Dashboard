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
    Route::post('/customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
    Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
    Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');

    Route::get('/credit/customer', 'CreditCustomer')->name('credit.customer');
    Route::get('/credit/customer/print/pdf', 'CreditCustomerPrintPdf')->name('credit.customer.print.pdf');
    Route::get('customer/edit/invoice/{invoice_id}', 'CustomerEditInvoice')->name('customer.edit.invoice');
    Route::post('customer/update/invoice/{invoice_id}', 'CustomerUpdateInvoice')->name('customer.update.invoice');
    Route::get('customer/invoice/details/{invoice_id}', 'CustomerInvoiceDetails')->name('customer.invoice.details.pdf');
    Route::get('paid/customer', 'PaidCustomer')->name('paid.customer');
    Route::get('paid/customer/print/pdf', 'PaidCustomerPrintPdf')->name('paid.customer.print.pdf');
    Route::get('customer/wise/report', 'CustomerWiseReport')->name('customer.wise.report');
    Route::get('customer/wise/credit/report', 'CustomerWiseCreditReport')->name('customer.wise.credit.report');
    Route::get('customer/wise/paid/report', 'CustomerWisePaidreport')->name('customer.wise.paid.report');
  



Route::post('/add_customer', [CustomerController::class, 'store'])->name('add_customer.store');

});











     Route::controller(InvoiceController::class)->group(function () {
         Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all');
         Route::get('/invoice/add', 'InvoiceAdd')->name('invoice.add');
         Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');
         Route::get('/invoice/pending/list', 'PendingList')->name('invoice.pending.list');
         Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('invoice.delete');
         Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('invoice.approve');
         Route::post('/approval/store/{id}', 'ApprovalStore')->name('approval.store');
         Route::get('/print/invoice/list', 'PrintInvoiceList')->name('print.invoice.list');
         Route::get('/print/invoice/{id}', 'PrintInvoice')->name('print.invoice');
         Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('daily.invoice.report');
         Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
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
