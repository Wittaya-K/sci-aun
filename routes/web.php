<?php

use App\Http\Controllers\AunController;
use App\Http\Controllers\Admin\AunCriteriaController;
use App\Http\Controllers\Admin\AunSubCriteriaController;
use App\Http\Controllers\Admin\AunItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

// ── Public ───────────────────────────────────────────────────

Route::get('/', fn () => redirect()->route('aun.show', 1));

Route::prefix('aun')->name('aun.')->group(function () {
    Route::get('/{number}', [AunController::class, 'show'])
        ->where('number', '[1-8]')->name('show');
    Route::get('/{number}/items/{item}', [AunController::class, 'showItem'])
        ->where('number', '[1-8]')->name('item.show');
    Route::get('/{number}/items/{item}/pdf/{attachment}', [AunController::class, 'streamPdf'])
        ->where('number', '[1-8]')->name('item.pdf');
});

// ── Admin ────────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', fn () => redirect()->route('admin.criteria.index'));

    Route::prefix('criteria')->name('criteria.')->group(function () {
        Route::get('/', [AunCriteriaController::class, 'index'])->name('index');
        Route::get('/{aunCriteria}/edit', [AunCriteriaController::class, 'edit'])->name('edit');
        Route::put('/{aunCriteria}', [AunCriteriaController::class, 'update'])->name('update');

        Route::prefix('/{aunCriteria}/sub-criteria')->name('sub-criteria.')->group(function () {
            // Route::get('/', [AunSubCriteriaController::class, 'index'])->name('index');
            // Route::get('/{aunSubCriteria}/edit', [AunSubCriteriaController::class, 'edit'])->name('edit');
            // Route::put('/{aunSubCriteria}', [AunSubCriteriaController::class, 'update'])->name('update');
            Route::get('/',        [AunSubCriteriaController::class, 'index'])->name('index');
            Route::get('/create',  [AunSubCriteriaController::class, 'create'])->name('create'); // ← เพิ่ม
            Route::post('/',       [AunSubCriteriaController::class, 'store'])->name('store');   // ← เพิ่ม
            Route::get('/{aunSubCriteria}/edit',  [AunSubCriteriaController::class, 'edit'])->name('edit');
            Route::put('/{aunSubCriteria}',       [AunSubCriteriaController::class, 'update'])->name('update');
            Route::delete('/{aunSubCriteria}',    [AunSubCriteriaController::class, 'destroy'])->name('destroy'); // ← เพิ่ม

            Route::prefix('/{aunSubCriteria}/items')->name('items.')->group(function () {
                Route::get('/', [AunItemController::class, 'index'])->name('index');
                Route::get('/create', [AunItemController::class, 'create'])->name('create');
                Route::post('/', [AunItemController::class, 'store'])->name('store');
                Route::get('/{aunItem}/edit', [AunItemController::class, 'edit'])->name('edit');
                Route::put('/{aunItem}', [AunItemController::class, 'update'])->name('update');
                Route::delete('/{aunItem}', [AunItemController::class, 'destroy'])->name('destroy');
                Route::post('/{aunItem}/attachments', [AunItemController::class, 'uploadAttachment'])->name('attachments.upload');
                Route::delete('/{aunItem}/attachments/{attachment}', [AunItemController::class, 'destroyAttachment'])->name('attachments.destroy');
            });
        });
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/',              [UserController::class, 'index'])->name('index');
        Route::get('/create',        [UserController::class, 'create'])->name('create');
        Route::post('/',             [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit',   [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}',        [UserController::class, 'update'])->name('update');
        Route::delete('/{user}',     [UserController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
