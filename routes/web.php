<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InstructureController;
use App\Http\Controllers\MemberController;



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

Route::get('/', function () {
    return view('welcome');

});



// Rwute Register

Route::group(['middleware' => 'auth'], function() { // Route authenticated users

    Route::group(['middleware' => 'role:admin'], function () { // Group route administrator
        Route::get('/BerandaAdmin', function () {
            return view('employee/admin/dashboard');
        });
        // Dashboard Admin
        Route::get('/employeeadmin', 'App\Http\Controllers\EmployeeController@indexadmin')->name('admin.index');
        
        
        // Tampil Data Instructure
        Route::get('/instructure', 'App\Http\Controllers\InstructureController@index')->name('instructure.index');
        // Search Data Instructure
        Route::get('/instructure/search', 'App\Http\Controllers\InstructureController@search')->name('instructure.search');
        // Store Data Instructure
        Route::post('/instructure/store', 'App\Http\Controllers\InstructureController@store')->name('instructure.store');
        // edit Data Instructure
        Route::get('/instructure/{id}/edit', 'App\Http\Controllers\InstructureController@edit')->name('instructure.edit');
        // Update Data Instructure
        Route::put('/instructure/{id}', 'App\Http\Controllers\InstructureController@update')->name('instructure.update');
        // Delete Data Instructure
        Route::delete('/instructure/{id}', 'App\Http\Controllers\InstructureController@delete')->name('instructure.delete');
        // Show Data Instructure
        Route::get('/instructure/{id}', 'App\Http\Controllers\InstructureController@show')->name('instructure.show');
    
    });


    Route::group(['middleware' => 'role:chashier'], function () { // Group route cashier
        Route::get('/BerandaCashier', function () {
            return view('employee/cashier/dashboard');
        });

        // Dashboard Cashier
        Route::get('/employeecashier', 'App\Http\Controllers\EmployeeController@indexcashier')->name('cashier.index');
        
        // Tampil Data Member
        Route::get('/member', 'App\Http\Controllers\MemberController@index')->name('member.index');
        // Search Data Member
        Route::get('/member/search', 'App\Http\Controllers\MemberController@search')->name('member.search');
        // Store Data Member
        Route::post('/member/store', 'App\Http\Controllers\MemberController@store')->name('member.store');
        // edit Data Member
        Route::get('/member/{id}/edit', 'App\Http\Controllers\MemberController@edit')->name('member.edit');
        // Update Data Member
        Route::put('/member/{id}', 'App\Http\Controllers\MemberController@update')->name('member.update');
        // Delete Data Member
        Route::delete('/member/{id}', 'App\Http\Controllers\MemberController@delete')->name('member.delete');
        // Show Data Member
        Route::get('/member/{id}', 'App\Http\Controllers\MemberController@show')->name('member.show');
        // Reset Password Member
        Route::put('/member/{id}/reset', 'App\Http\Controllers\MemberController@resetPassword')->name('member.reset');
        // Generate Member Card using PDF
        Route::get('/member/{id}/card', 'App\Http\Controllers\MemberController@card')->name('member.card');

        // Tampil Data Transaction
        Route::get('/transaction', 'App\Http\Controllers\TransactionController@indexall')->name('transaction.index');

        // Tampil Data Deposit Uang
        Route::get('/deposituang', 'App\Http\Controllers\DepositController@indexdeposituang')->name('deposit.indexdeposituang');
         // Search Data Deposit Uang
            Route::get('/deposituang/search', 'App\Http\Controllers\DepositController@searchdeposituang')->name('deposit.searchdeposituang');
            // Store Data Deposit Uang
            Route::post('/deposituang/store', 'App\Http\Controllers\DepositController@storedeposituang')->name('deposit.storedeposituang');
        
        
        
        // Tampil Data Deposit Kelas
        Route::get('/depositkelas', 'App\Http\Controllers\DepositController@indexdepositkelas')->name('deposit.indexdepositkelas');
       
       
       
        // Tampil Data Membership
        Route::get('/membership', 'App\Http\Controllers\MembershipController@index')->name('membership.index');
        // Search Data Membership
        Route::get('/membership/search', 'App\Http\Controllers\MembershipController@search')->name('membership.search');
        // Store Data Membership
        Route::post('/membership/store', 'App\Http\Controllers\MembershipController@store')->name('membership.store');
        // edit Data Membership
        Route::get('/membership/{id}/edit', 'App\Http\Controllers\MembershipController@edit')->name('membership.edit');
        // Update Data Membership
        Route::put('/membership/{id}', 'App\Http\Controllers\MembershipController@update')->name('membership.update');
        // Delete Data Membership
        Route::delete('/membership/{id}', 'App\Http\Controllers\MembershipController@delete')->name('membership.delete');
        // Show Data Membership
        Route::get('/membership/{id}', 'App\Http\Controllers\MembershipController@show')->name('membership.show');
        // Generate Membership Card using PDF
        Route::get('/membership/{id}/card', 'App\Http\Controllers\MembershipController@card')->name('membership.card');

    });

    // Route Group Manager
    Route::group(['middleware' => 'role:manager'], function () { // Group route manager
        Route::get('/BerandaManager', function () {
            return view('employee/manager/dashboard');
            });
       
         // Dashboard Manager
        Route::get('/employeemanager', 'App\Http\Controllers\EmployeeController@indexmanager')->name('manager.index');
       
        // Tampil Data Timetable
        Route::get('/timetable', 'App\Http\Controllers\TimetableController@index')->name('timetable.index');
        
        //Generate Timetable
        Route::get('/timetable/generate', 'App\Http\Controllers\TimetableController@generate')->name('timetable.generate');
        // Store Data Timetable
        Route::post('/timetable/store', 'App\Http\Controllers\TimetableController@store')->name('timetable.store');
        // edit Data Timetable
        Route::get('/timetable/{id}/edit', 'App\Http\Controllers\TimetableController@edit')->name('timetable.edit');
        // Update Data Timetable
        Route::put('/timetable/{id}', 'App\Http\Controllers\TimetableController@update')->name('timetable.update');
        // Delete Data Timetable
        Route::delete('/timetable/{id}', 'App\Http\Controllers\TimetableController@delete')->name('timetable.delete');
        // Show Data Timetable
        Route::get('/timetable/{id}', 'App\Http\Controllers\TimetableController@show')->name('timetable.show');
        
        // Tampil Data Instructure Permission
        Route::get('/instructurepermission', 'App\Http\Controllers\InstructurePermissionController@index')->name('instructurepermission.index');
        //update and give permission to instructure
        Route::put('/instructurepermission/{id}', 'App\Http\Controllers\InstructurePermissionController@give')->name('permission.update');
        
    
    });
    



// Logout
    Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});
});
