<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('geomap'); // Ensure you have a Blade template named 'geomap.blade.php'
    }
}
