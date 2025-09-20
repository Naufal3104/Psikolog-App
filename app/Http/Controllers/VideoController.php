<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return response()->json(Video::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'url' => 'required|url',
            'penulis_id' => 'required|exists:users,id',
            'kategori' => 'nullable|string',
            'views' => 'nullable|integer',
        ]);
        return $this->storeResource($request, Video::class);
    }

    public function show($id)
    {
        return $this->getResource(Video::class, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->updateResource($request, $id, Video::class);
    }

    public function destroy($id)
    {
        return $this->destroyResource($id, Video::class);
    }
}
