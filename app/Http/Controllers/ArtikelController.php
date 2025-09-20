<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return response()->json(Artikel::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'slug' => 'required|unique:artikel',
            'isi' => 'required|string',
            'penulis_id' => 'required|exists:users,id',
            'gambar' => 'nullable|string',
            'keterangan_gambar' => 'nullable|string',
            'views' => 'nullable|integer',
        ]);
        return $this->storeResource($request, Artikel::class);
    }

    public function show($id)
    {
        return $this->getResource(Artikel::class, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateResource($request, $id, Artikel::class);
    }

    public function destroy($id)
    {
        return $this->destroyResource($id, Artikel::class);
    }
}
