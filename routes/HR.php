<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HR\HRController;
use App\Http\Controllers\vacation;
use App\Http\Controllers\permision;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::prefix('/HR')->group(function (){

    Route::get('/pendinghr', [HRController::class,'pendingHrView'])->name('pendingHrView');
    Route::get('/approvehr', [HRController::class,'ApproveHrView'])->name('ApproveHrView');
    Route::get('/Rejecthr', [HRController::class,'RejectHRView'])->name('RejectHRView');
    Route::get('/AllUsers', [HRController::class,'AllUsersView'])->name('AllUsersView');
    Route::get('/EditPermission', [HRController::class,'EditPermissionView'])->name('EditPermissionView');
    Route::get('/EditVacation', [HRController::class,'EditVacationView'])->name('EditVacationView');
    Route::get('/Excel', [HRController::class,'ExcelView'])->name('ExcelView');
    Route::get('/Hr', [HRController::class,'HrView'])->name('HrView');
    Route::get('/HRApproveUser', [HRController::class,'HRApproveUserView'])->name('HRApproveUserView');
    Route::get('/Hrcancel', [HRController::class,'HrcancelView'])->name('HrcancelView');
    Route::get('/HrcancelPer', [HRController::class,'HrcancelPerView'])->name('HrcancelPerView');
    Route::get('/HrPer', [HRController::class,'HrPerView'])->name('HrPerView');
    Route::get('/HRUpdateVacation', [HRController::class,'HuView'])->name('HuView');
    Route::get('/HuPer', [HRController::class,'HuPerView'])->name('HuPerView');
    Route::get('/pendingcancel', [HRController::class,'pendingcancelView'])->name('pendingcancelView');
    Route::get('/vacachange', [HRController::class,'vacachangeView'])->name('vacachangeView');
    Route::get('/vacationchange', [HRController::class,'vacationchangeView'])->name('vacationchangeView');
    Route::get('/HRHistory', [HRController::class,'HRHistoryView'])->name('HRHistory');
    Route::get('/HRUpdatePermission',[HRController::class,'HRUpdatePermissionView'])->name('HRUpdatePermission');
    Route::get('/UsersRequests',[HRController::class,'UsersRequestsView'])->name('UsersRequests');



    Route::get('/getinformationUser/{id}',[HRController::class,'getinformationUser']);
    Route::post('/ActionToUser/{id}',[HRController::class,'ActionToHREmplpyee']);
    Route::get('/UpdateStatus/{id}',[HRController::class,'UpdateStatus']);
    Route::post('/UpdateHREmployee/{id}',[HRController::class,'UpdateHREmployee']);
    Route::get('/EditVacationForUser/{id}',[HRController::class,'EditVacationForUserView']);
    Route::post('/ActionEditVacationForUser/{id}',[HRController::class,'DoingEditVacationForUser']);
    Route::post('/GetVacationExcel',[HRController::class,'ExportVacation']);
    Route::get('/CanacelVacation/{id}',[HRController::class,'DoingCanacelVacation']);
    Route::post('/ChangeVacationBalance/{id}',[HRController::class,'DoingChangeVacationBalance']);
    Route::get('/HRUpdateVacation/{id}',[HRController::class,'HRUpdateVacationFunction']);
    Route::post('/doingHRUpdateVacation/{id}',[HRController::class,'DoneHRUpdateVacation']);
    Route::post('/DawonloadExecl',[HRController::class,'DawonloadExeclFunction']);
    Route::get('/FinishRequest/{id}',[HRController::class,'FinishRequestFunction']);
    Route::get('/PendingRequest/{id}',[HRController::class,'PendingRequestFunction']);



    Route::get('/ApprovePermission/{id}',[HRController::class,'ApprovePermissionFunction']);
    Route::post('/DoingApprovePermission/{id}',[HRController::class,'DoneApprovePermissionFunction']);
    Route::get('/UpdateApprovePermission/{id}',[HRController::class,'UpdateApprovePermissionFunction']);
    Route::post('/DoingUpdateApprovePermission/{id}',[HRController::class,'DoneUpdateApprovePermissionFunction']);
    Route::get('/EditPermissionForUser/{id}',[HRController::class,'EditPermissionForUserView']);
    Route::post('/ActionEditPermissionForUser/{id}',[HRController::class,'DoingEditPermissionForUser']);
    Route::post('/GetPermissionExcel',[HRController::class,'ExportPermission']);
    Route::get('/CanacelPermission/{id}',[HRController::class,'DoingCanacelPermission']);
    Route::get('/HRUpdatePermission/{id}',[HRController::class,'HRUpdatePermissionFunction']);
    Route::post('/doingHRUpdatePermission/{id}',[HRController::class,'DoneHRUpdatePermission']);


});
