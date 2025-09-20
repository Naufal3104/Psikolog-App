<?php

namespace App\Http\Controllers;

use App\Models\DeteksiDini;
use Illuminate\Http\Request;

class DeteksiDiniController extends Controller
{
    public function index()
    {
        return response()->json(DeteksiDini::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'form_id' => 'required|integer',
            'skor' => 'required|integer',
            'hasil' => 'required|string',
            'tanggal_deteksi' => 'required|date',
        ]);
        return $this->storeResource($request, DeteksiDini::class);
    }

    public function show($id)
    {
        return $this->getResource(DeteksiDini::class, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateResource($request, $id, DeteksiDini::class);
    }

    public function destroy($id)
    {
        return $this->destroyResource($id, DeteksiDini::class);
    }
}
