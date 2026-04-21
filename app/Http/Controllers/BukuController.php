<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Repositories\BukuRepo;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function __construct(protected BukuRepo $bukuRepo) {}

    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $bukus = $this->bukuRepo->getAllBukus(
            $request->user()->user_id,
            $request->string('search')->toString()
        );

        return ResponseHelper::success($bukus, 'Buku list fetched');
    }

    public function show(Request $request, int $id)
    {
        $buku = $this->bukuRepo->getBukuById($request->user()->user_id, $id);

        if (! $buku) {
            return ResponseHelper::error('Buku not found', 404);
        }

        return ResponseHelper::success($buku, 'Buku fetched');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'tanggal_terbit' => ['required', 'date'],
            'category' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
        ]);

        $data['user_id'] = $request->user()->user_id;

        $buku = $this->bukuRepo->createBuku($data);

        return ResponseHelper::success($buku, 'Buku created successfully', 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'author' => ['sometimes', 'required', 'string', 'max:255'],
            'tanggal_terbit' => ['sometimes', 'required', 'date'],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'genre' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $buku = $this->bukuRepo->updateBuku($request->user()->user_id, $id, $data);

        if (! $buku) {
            return ResponseHelper::error('Buku not found', 404);
        }

        return ResponseHelper::success($buku, 'Buku updated successfully');
    }

    public function destroy(Request $request, int $id)
    {
        if (! $this->bukuRepo->deleteBuku($request->user()->user_id, $id)) {
            return ResponseHelper::error('Buku not found', 404);
        }

        return ResponseHelper::success(null, 'Buku deleted successfully');
    }
}
