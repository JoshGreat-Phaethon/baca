<?php 
namespace App\Interfaces;

interface BukuInterfaces
{
    public function getAllBukus();
    public function getBukuById($id);
    public function createBuku(array $data);
    public function updateBuku($id, array $data);
    public function deleteBuku($id);
}