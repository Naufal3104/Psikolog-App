<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index()
    {
        return response()->json(Infografis::all());
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
