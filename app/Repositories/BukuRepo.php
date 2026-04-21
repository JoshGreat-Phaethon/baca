<?php 
namespace App\Repositories;
use App\Models\Buku;
use App\Interfaces\BukuInterfaces;

class BukuRepo implements BukuInterfaces
{
    public function getAllBukus()
    {
        return Buku::all();
    }
    public function getBukuById($id)
    {
        return Buku::find($id);
    }
    public function createBuku(array $data)
    {
        return Buku::create($data);
    }
    public function updateBuku($id, array $data)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $buku->update($data);
            return $buku;
        }
        return null;
    }
    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $buku->delete();
            return true;
        }
        return false;
    }
}