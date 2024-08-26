<?
namespace App\Repositories;

interface NegaraRepositoryInterface {
    public function getAllNegara();
    public function createNegara(array $data);
    public function deleteNegara($id);
}
?>