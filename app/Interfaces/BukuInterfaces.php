<?php

namespace App\Interfaces;

interface BukuInterfaces
{
    public function getAllBukus(int $userId, ?string $query = null);
    public function getBukuById(int $userId, int $id);
    public function createBuku(array $data);
    public function updateBuku(int $userId, int $id, array $data);
    public function deleteBuku(int $userId, int $id);
}
