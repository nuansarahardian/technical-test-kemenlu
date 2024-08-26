<?php
use App\Http\Controllers\Api\NegaraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoJSONController;
// Route::apiResource('negara', NegaraController::class);


Route::get('/api/geojson', [GeoJSONController::class, 'getGeoJSON'])->name('api.geojson');
Route::get('/negara', [NegaraController::class, 'index'])->name('api.negara');;

Route::post('/negara', [NegaraController::class, 'store']);
Route::delete('/negara/{id}', [NegaraController::class, 'destroy']);
?>
