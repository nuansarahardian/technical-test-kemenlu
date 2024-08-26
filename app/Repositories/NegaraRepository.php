<?
namespace App\Repositories;

use App\Models\Negara;

class NegaraRepository implements NegaraRepositoryInterface {
    public function getAllNegara() {
        return Negara::with('kawasan', 'direktorat')->get(); // Mengambil semua data negara beserta relasinya
    }

    public function createNegara(array $data) {
        return Negara::create($data); // Membuat negara baru dengan data yang diberikan
    }

    public function deleteNegara($id) {
        $negara = Negara::find($id); // Mencari negara berdasarkan ID
        if ($negara) {
            return $negara->delete(); // Menghapus negara jika ditemukan
        }
        return false;
    }
}
