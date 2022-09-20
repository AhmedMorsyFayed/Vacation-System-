<?php


use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;



Auth::routes();


Route::prefix('Admin')->group(function (){

    Route::get('/AllVacation', [AdminController::class,'AllVacationView'])->name('AllVacation');
    Route::get('/UsersPassword',[AdminController::class,'AllUsers'])->name('UsersPassword');
    Route::get('/PublicVacations',[AdminController::class,'PublicVacationsFunction'])->name('PublicVacations');



    Route::get('/UsersPassword/{id}',[AdminController::class,'UsersPassword']);
    Route::post('/UpdatePublicVacations/{id}',[AdminController::class,'UpdatePublicVacations']);
    Route::get('/del/{type}', [AdminController::class,'delete']);
    Route::post('/AddPublicVacations',[AdminController::class,'AddPublicVacationsFunction']);

});
