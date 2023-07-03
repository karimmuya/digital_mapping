<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\User\PortionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PDFController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PortionsController;
use App\Http\Controllers\Admin\BuyAdminController;
use App\Http\Controllers\User\BuyUserController;
use App\Http\Controllers\Admin\PaymentsController;




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


Route::get('/', [PortionController::class, 'index']);
Route::resource('portions', PortionController::class);
Route::resource('profile', ProfileController::class);
Route::resource('admin', DashboardController::class);
Route::resource('manage_lands', LandsController::class);
Route::resource('manage_users', UsersController::class);
Route::resource('manage_portions', PortionsController::class);
Route::resource('manage_buys', BuyAdminController::class);
Route::resource('manage_payments', PaymentsController::class);

Route::resource('buys', BuyUserController::class);

// Custom functions
Route::post('/release/{id}', [BuyUserController::class, 'release']);
Route::post('/releaseadm/{id}', [BuyAdminController::class, 'release']);
Route::post('/postpone/{id}', [BuyAdminController::class, 'release']);
Route::get('/pdf/{id}', [PDFController::class, 'generatePDF']);
Route::post('payslip/upload/{id}', [BuyUserController::class, 'upload']);








Route::get('/portion/{id}', function ($id) {
        $user = DB::table('portions')->find($id);
        return response()->json($user);
});
