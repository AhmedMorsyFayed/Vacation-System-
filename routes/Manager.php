<?php






use App\Http\Controllers\Manager\ManagerController;

use Illuminate\Support\Facades\Route;





Route::prefix('/Manager')->group(function (){


    Route::get('/approve',[ManagerController::class,'ApproveManagerView'])->name('ApproveView');
    Route::get('/pending',[ManagerController::class,'pendingManagerView'])->name('PendingView');
    Route::get('/Reject',[ManagerController::class,'RejectManagerView'])->name('RejectView');
    Route::get('/ApproveManager',[ManagerController::class,'ApproveView'])->name('ApproveManager');
    Route::get('/UpdateApproveManager',[ManagerController::class,'UpdateApproveManagerView']);
    Route::get('/History',[ManagerController::class,'HistoryView'])->name('History');
    Route::get('/ExcelManager',[ManagerController::class,'ExcelManagerView'])->name('ExcelManager');


    Route::get('/ApproveVacation/{id}',[ManagerController::class,'UserVacationFunction']);
    Route::post('/DoingApproveVacation/{id}',[ManagerController::class,'DoneApproveVacation']);
    Route::get('/UpdateApprovalM/{id}',[ManagerController::class,'UpdateApproval']);
    Route::post('/DoingUpdateApproval/{id}',[ManagerController::class,'DoneUpdateApproval']);

    Route::get('/ApprovePermission/{id}',[ManagerController::class,'UserPermissionFunction']);
    Route::post('/DoingApprovePermission/{id}',[ManagerController::class,'DoneApprovePermission']);
    Route::get('/UpdateApprovalP/{id}',[ManagerController::class,'UpdateApprovalPermission']);
    Route::post('/DoingUpdateApprovalP/{id}',[ManagerController::class,'DoneUpdateApprovalPermission']);


    Route::get('/Vacations',[ManagerController::class,'VacationsView'])->name('Vacations');
    Route::get('/ExcelTopManager',[ManagerController::class,'ExcelTopManagerView'])->name('ExcelTopManager');
    Route::get('/UpdateApprovalTop/{id}',[ManagerController::class,'UpdateApprovalTop']);
    Route::post('/DoingUpdateApprovalTop/{id}',[ManagerController::class,'DoneUpdateApprovalTop']);


    Route::post('/ExcelUser',[ManagerController::class,'ExportTopManager']);
    Route::post('/Excelmanager',[ManagerController::class,'ExcelManagerReport']);



});






