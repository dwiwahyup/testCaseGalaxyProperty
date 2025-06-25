<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('employee', EmployeeController::class);

    Route::group(['prefix' => 'payment'], function () {
        route::get('/', [SalaryPaymentController::class, 'index'])->name('payment.index');
        route::get('/detail/{id}', [SalaryPaymentController::class, 'show'])->name('payment.detail');
        // Salary Calculation Route
        Route::post('/salary/calculate', [SalaryPaymentController::class, 'salaryCalculation'])->name('payment.salary.calculate');

        // Salary Request Routes
        Route::get('/salary/request', [SalaryPaymentController::class, 'salaryRequest'])->name('payment.salary.request.create');
        Route::post('/salary/request/store', [SalaryPaymentController::class, 'salaryStore'])->name('payment.salary.request.store');

        //Salary Approval
        Route::get('/salary/approval/{id}', [SalaryPaymentController::class, 'showRequest'])->name('payment.salary.approval.show');
        Route::post('/salary/approval/{id}/approve', [SalaryPaymentController::class, 'approve'])->name('payment.salary.approval.approve');
        Route::post('/salary/approval/{id}/reject', [SalaryPaymentController::class, 'reject'])->name('payment.salary.approval.reject');

        //Salary Payment
        Route::get('/salary/payment/{id}/process', [SalaryPaymentController::class, 'process'])->name('payment.salary.payment.process');
        Route::post('/salary/payment/{id}/complete', [SalaryPaymentController::class, 'complete'])->name('payment.salary.payment.complete');

        //report
        ROute::get('/salary/report', [SalaryPaymentController::class, 'paymentReport'])->name('payment.salary.report.index');
        Route::get('/salary/report/{id}', [SalaryPaymentController::class, 'showReport'])->name('payment.salary.report.show');
       
    });

    Route::middleware('auth')->group(function () {
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
        });

});
require __DIR__.'/auth.php';
