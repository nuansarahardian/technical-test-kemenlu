<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoJSONController extends Controller
{
    public function getGeoJSON()
    {
        $path = storage_path('app/public/map.geojson'); 
        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return response()->json(['error' => 'GeoJSON file not found.'], 404);
        }
    }
}
