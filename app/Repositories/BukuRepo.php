<?php

namespace App\Repositories;

use App\Interfaces\BukuInterfaces;
use App\Models\Buku;

class BukuRepo implements BukuInterfaces
{
    public function getAllBukus(int $userId, ?string $query = null)
    {
        return Buku::query()
            ->where('user_id', $userId)
            ->when($query, function ($builder, $query) {
                $builder->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('author', 'like', "%{$query}%")
                        ->orWhere('category', 'like', "%{$query}%")
                        ->orWhere('genre', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->get();
    }

    public function getBukuById(int $userId, int $id)
    {
        return Buku::where('user_id', $userId)->find($id);
    }

    public function createBuku(array $data)
    {
        return Buku::create($data);
    }

    public function updateBuku(int $userId, int $id, array $data)
    {
        $buku = Buku::where('user_id', $userId)->find($id);

        if (! $buku) {
            return null;
        }

        $buku->update($data);

        return $buku;
    }

    public function deleteBuku(int $userId, int $id)
    {
        $buku = Buku::where('user_id', $userId)->find($id);

        if (! $buku) {
            return false;
        }

        $buku->delete();

        return true;
    }
}
