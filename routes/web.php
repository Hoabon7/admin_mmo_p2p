<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ctv\CtvController;
use App\Http\Controllers\admin\ManagingCtvController;
use App\Http\Controllers\ctv\ForgotPasswordController;
use App\Http\Controllers\admin\ManagingCustomerController;

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

Auth::routes();
Route::get('logout',[LoginController::class, 'logOut'])->name('logout')->middleware('auth');
Route::get('login',[LoginController::class, 'login'])->name('login');
Route::post('check_login',[LoginController::class, 'checkLogin'])->name('check_login');

Route::group(['prefix' => 'member', 'as' => 'member.', 'middleware' => 'auth'], function() {
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function(){
        Route::get('/all', [ManagingCustomerController::class, 'getListCustomer'])->name('all');
        Route::get('/{id}/detail', [ManagingCustomerController::class, 'getDetailCustomer'])->name('detail');
        Route::get('/{id}/update_role/{role}', [ManagingCustomerController::class, 'setCustomerBecomeBusinessmen'])->name('update_role');
        Route::get('/{id}/update_status/{status}', [ManagingCustomerController::class, 'isDisableStatus'])->name('update_status');

        Route::get('{id}/add_reason/',[ManagingCustomerController::class, 'createReason'])->name('add_reason');
        Route::post('/store_reason',[ManagingCustomerController::class, 'storeReason'])->name('store_reason');
    });
    Route::group(['prefix' => 'ctv', 'as' => 'ctv.', 'middleware' => ['is_admin']], function(){
        Route::get('/all', [ManagingCtvController::class, 'all'])->name('all');
        Route::get('/{id}/detail', [ManagingCtvController::class, 'getDetail'])->name('detail');
        Route::get('/{id}/update_status/{status}',[ManagingCtvController::class, 'isDisableStatus'])->name('update_status');
        Route::get('/create', [ManagingCtvController::class, 'create'])->name('create');
        Route::post('/store', [ManagingCtvController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [ManagingCtvController::class, 'edit'])->name('edit');
        Route::post('/update', [ManagingCtvController::class, 'update'])->name('update');
    });
});

Route::group(['prefix' => 'ctv', 'as' => 'ctv.'], function() {
    Route::group(['middleware' => ['auth', 'is_ctv']], function(){
        Route::get('change_password', [CtvController::class, 'createChangePassword'])->name('change_password');
        Route::post('update_password', [CtvController::class, 'updatePassword'])->name('update_password');
    });
    
});

Route::group(['prefix' => 'forgot_password', 'as' => 'forgot_password.'], function() {
    Route::get('create',[ForgotPasswordController::class, 'create'])->name('create');
    Route::get('find/{token}',[ForgotPasswordController::class, 'find'])->name('find');
    Route::post('store',[ForgotPasswordController::class, 'store'])->name('store');
    Route::post('reset',[ForgotPasswordController::class,'reset'])->name('reset');
});


