<?php

namespace App\Http\Controllers;

use App\Models\TanyaJawab;
use Illuminate\Http\Request;

class TanyaJawabController extends Controller
{
    public function index()
    {
        return response()->json(TanyaJawab::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pertanyaan' => 'required|string',
            'jawaban' => 'nullable|string',
            'psikiater_id' => 'nullable|exists:users,id',
            'status' => 'required|in:belum dijawab,sudah dijawab',
            'kategori' => 'nullable|string',
            'views' => 'nullable|integer',
        ]);
        return $this->storeResource($request, TanyaJawab::class);
    }

    public function show($id)
    {
        return $this->getResource(TanyaJawab::class, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateResource($request, $id, TanyaJawab::class);
    }

    public function destroy($id)
    {
        return $this->destroyResource($id, TanyaJawab::class);
    }
}
