<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrcController;

Route::middleware(['superAdmin','revalidate'])->group(function() {
    Route::get('/prcResults', [PrcController::class, 'index'])->name('admin.prc');
    Route::get('/prcResults/add', [PrcController::class, 'addInitial'])->name('admin.prc.addInitial');
    Route::get('/prcResults/add/manual', [PrcController::class, 'add'])->name('admin.prc.add.manual');
    Route::get('/prcResults/add/upload', [PrcController::class, 'addUpload'])->name('admin.prc.add.upload');
    Route::post('/prcResults/upload-ocr', [PrcController::class, 'processOCR'])->name('admin.prc.ocr.process');
    Route::get('/prc/search', [PrcController::class, 'search'])->name('admin.prc.search');
    Route::post('/prcResults/store', [PrcController::class, 'store'])->name('admin.prc.store');
    Route::get('/prcResults/{id}', [PrcController::class, 'view'])->name('admin.prc.view');

    Route::put('/prcResults/{id}', [PrcController::class, 'update'])->name('admin.prc.update');
    Route::delete('/prcResults/{id}', [PrcController::class, 'destroy'])->name('admin.prc.delete');
    Route::get('/prcResults/{id}/export', [PrcController::class, 'exportExcel'])->name('admin.prc.export');
});
?>
