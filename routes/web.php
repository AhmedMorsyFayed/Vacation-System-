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



use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\NoMiddelWare;
use App\Http\Controllers\vacation;
use App\Http\Controllers\permision;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('/', function () {
    return view('welcome');
})->name('/');




Route::get('/home', 'HomeController@HomeView')->name('home');
Route::get('/ApproveVacations',[HomeController::class,'ApproveVacationsView'])->name('ApproveVacations');
Route::get('/PendingVacations',[HomeController::class,'PendingVacationsView'])->name('PendingVacations');
Route::get('/RejectVacations',[HomeController::class,'RejectVacationsView'])->name('RejectVacations');
Route::get('/TakeVacation',[HomeController::class,'TakeVacationView'])->name('TakeVacation');
Route::get('/TakePermision',[HomeController::class,'TakePermisionView'])->name('TakePermision');
Route::get('/request',[HomeController::class,'RequestView'])->name('Request');
Route::get('/Suggest',[NoMiddelWare::class,'SuggestView'])->name('SuggestView');
Route::get('/ShowSuggestions',[HomeController::class,'ShowSuggestionsView'])->name('ShowSuggestions');
Route::get('/printingSuggetions',[HomeController::class,'printingSuggetionsView'])->name('printingSuggetions');
Route::get('/ChangePassword',[HomeController::class,'ChangePasswordView'])->name('ChangePassword');


Route::get('/ForcePassword',[HomeController::class,'ForcePasswordFirstLogin'])->name('ForcePassword');
Route::post('DoningForcePassword',[vacation::class,'ForceChangeFunction']);
Route::post('CancelUserVacation',[vacation::class,'CancelUserVacation']);
Route::post('/BokeVacation',[vacation::class,'BokeVacationFunction']);
Route::post('/InsertRequest',[vacation::class,'InsertRequestFunction']);
Route::post('/insertRequest',[NoMiddelWare::class,'InsertRequest']);
Route::post('/ChangePasswordUser',[vacation::class,'ChangePasswordFunction']);




Route::post('/CancelUserPermission',[permision::class,'CancelUserPermission']);
Route::post('BokePermission',[permision::class,'BokePermissionFunCtion']);





