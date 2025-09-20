<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        return response()->json(Konsultasi::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'gambar' => 'nullable|string',
            'views' => 'nullable|integer',
        ]);
        return $this->storeResource($request, Konsultasi::class); // Memanggil storeResource dari Controller.php
    }

    public function show($id)
    {
        return $this->getResource(Konsultasi::class, $id); // Memanggil getResource dari Controller.php
    }

    public function update(Request $request, $id)
    {
        return $this->updateResource($request, $id, Konsultasi::class); // Memanggil updateResource dari Controller.php
    }

    public function destroy($id)
    {
        return $this->destroyResource($id, Konsultasi::class); // Memanggil destroyResource dari Controller.php
    }
}
 