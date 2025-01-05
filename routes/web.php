<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElementMappingController;
use App\Http\Controllers\TransformedContentController;

// Welcome page
Route::get('/', function () {
    return view('welcomePage');
});

// Element pages
Route::get('/listElements', [ElementMappingController::class, 'showAll'])->name('ElementMappingController.showAll');
Route::get('/addElement', function () { return view('elementMappingForm'); })->name('ElementMappingController.showAdd');
Route::post('/submitElement', [ElementMappingController::class, 'add'])->name('ElementMappingController.add');
Route::get('/editElement/{id}', [ElementMappingController::class, 'showEdit'])->name('ElementMappingController.showEdit');
Route::put('/editElement/{id}', [ElementMappingController::class, 'edit'])->name('ElementMappingController.edit');

// Transformed pages
Route::get('/listTransformedContents', [TransformedContentController::class, 'showAll'])->name('TransformedElementController.showAll');
Route::get('/submitContent', function () { return view('transformedElementForm'); })->name('TransformedElementController.showAdd');
Route::post('/transformContent', [TransformedContentController::class, 'add'])->name('TransformedElementController.add');

