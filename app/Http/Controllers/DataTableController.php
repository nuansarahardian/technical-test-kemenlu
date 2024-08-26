<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $response = Http::get('http://127.0.0.1:8000/api/negara'); 
            $data = $response->json()['data']; 

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kawasan', function($row) {
                    return $row['kawasan'] ?? 'N/A'; 
                })
                ->addColumn('direktorat', function($row) {
                    return $row['direktorat'] ?? 'N/A'; 
                })
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="delete btn btn-danger btn-sm" data-id="'.$row['id_negara'].'">Delete</button>';
                    return $btn;
                })
                ->addColumn('created_at', function($row) {
                    return date('Y/m/d', strtotime($row['created_at'])); 
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('index');
    }

    public function destroy($id)
    {
        $response = Http::delete("http://127.0.0.1:8000/api/negara/{$id}"); 
        
        if ($response->successful()) {
            return response()->json(['success' => 'Negara deleted successfully.']);
        }
        return response()->json(['error' => 'Negara not found.'], 404);
    }
}
