<?php

namespace App\Http\Controllers\Api;

use App\Models\Negara;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NegaraController extends Controller
{
    public function index(Request $request) {
        $perPage = $request->input('length', 10); // jumlah data per halaman
        $page = $request->input('start', 0) / $perPage + 1; // halaman saat ini

        $query = Negara::with('kawasan', 'direktorat');

        // Menambahkan pencarian jika ada
        if ($search = $request->input('search.value')) {
            $query->where(function($query) use ($search) {
                $query->where('nama_negara', 'like', "%{$search}%")
                      ->orWhereHas('kawasan', function($q) use ($search) {
                          $q->where('nama_kawasan', 'like', "%{$search}%");
                      })
                      ->orWhereHas('direktorat', function($q) use ($search) {
                          $q->where('nama_direktorat', 'like', "%{$search}%");
                      });
            });
        }

        $totalRecords = $query->count(); // Total records tanpa filter
        $data = $query->skip($request->input('start', 0))
                      ->take($perPage)
                      ->get();

        return response()->json([
            'draw' => (int) $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'id_kawasan' => 'required|exists:kawasan,id_kawasan',
            'id_direktorat' => 'required|exists:direktorat,id_direktorat',
            'nama_negara' => 'required|string|max:255',
            'kode_negara' => 'required|string|size:2',
        ]);

        $negara = Negara::create($data);
        return response()->json($negara, 201);
    }

    public function destroy($id) {
        $negara = Negara::where('id_negara', $id)->first();
    
        if ($negara) {
            $negara->delete();
            return response()->json(['message' => 'Negara deleted successfully']);
        }
    
        return response()->json(['message' => 'Negara not found'], 404);
    }
}
