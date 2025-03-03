<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('news/{id}', [NewsController::class, 'view'])->name('news.view');
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.news.index');
    })->name('admin.index');
    Route::get('news', [NewsController::class, 'indexAdmin'])->name('admin.news.index');
    Route::get('news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
});
