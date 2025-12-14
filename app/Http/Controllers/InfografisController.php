<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index()
    {
        // Mengambil semua data infografis diurutkan dari yang terbaru
        $infografis = Infografis::latest()->get();

        // Arahkan ke file view Anda (sesuaikan nama foldernya, misal: fitur.infografis)
        return view('fitur.infografis', compact('infografis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'gambar_url' => 'required|string',
            'kategori' => 'nullable|string',
            'views' => 'nullable|integer',
            'penulis_id' => 'required|exists:users,id',
        ]);
        return $this->storeResource($request, Infografis::class);
    }

    public function show($id)
    {
        return $this->getResource(Infografis::class, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateResource($request, $id, Infografis::class);
    }

    public function destroy($id)
    {
        return $this->destroyResource($id, Infografis::class);
    }
}
