<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\GeoJSONController;

Route::get('/api/geojson', [GeoJSONController::class, 'getGeoJSON'])->name('api.geojson');
Route::get('/geomap', [MapController::class, 'index'])->name('geomap');
Route::get('/', [DataTableController::class, 'index'])->name('datatables');
Route::delete('/negara/{id}', [DataTableController::class, 'destroy']);
Auth::routes();


