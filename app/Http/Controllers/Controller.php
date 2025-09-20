<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Controller 
{
    /**
     * Menangani pengecekan dan pengembalian data untuk resource.
     */
    public function getResource($model, $id)
    {
        try {
            $resource = $model::findOrFail($id);
            return response()->json($resource);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Membuat resource baru.
     */
    public function storeResource(Request $request, $model)
    {
        $modelInstance = $model::create($request->all());
        return response()->json($modelInstance, 201);
    }

    /**
     * Memperbarui resource yang ada.
     */
    public function updateResource(Request $request, $id, $model)
    {
        try {
            $resource = $model::findOrFail($id);
            $resource->update($request->all());
            return response()->json($resource);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Menghapus resource.
     */
    public function destroyResource($id, $model)
    {
        try {
            $resource = $model::findOrFail($id);
            $resource->delete();
            return response()->json(['message' => 'Deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}

