<?php 
namespace App\Http\Controllers;
use App\Repositories\BukuRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;

class BukuController extends Controller
{
    protected $bukuRepo;
    public function __construct(BukuRepo $bukuRepo)
    {
        $this->bukuRepo = $bukuRepo;
    }
    public function index()
    {
        $bukus = $this->bukuRepo->getAllBukus();
        return ResponseHelper::success($bukus);
    }
    public function show($id)
    {
        $buku = $this->bukuRepo->getBukuById($id);
        if ($buku) {
            return ResponseHelper::success($buku);
        }
        return ResponseHelper::error('Buku not found', 404);
    }
    public function store(Request $request)
    {
        $data = $request->only(['name', 'author', 'tanggal_terbit', 'category', 'genre']);
        $buku = $this->bukuRepo->createBuku($data);
        return ResponseHelper::success($buku, 201);
    }
    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'author', 'tanggal_terbit', 'category', 'genre']);
        $buku = $this->bukuRepo->updateBuku($id, $data);
        if ($buku) {
            return ResponseHelper::success($buku);
        }
        return ResponseHelper::error('Buku not found', 404);
    }
    public function destroy($id)
    {
        if ($this->bukuRepo->deleteBuku($id)) {
            return ResponseHelper::success(null, 'Buku deleted successfully');
        }
        return ResponseHelper::error('Buku not found', 404);
    }
}