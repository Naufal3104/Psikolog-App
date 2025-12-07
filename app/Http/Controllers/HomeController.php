<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $artikelHome = Artikel::orderBy('created_at', 'desc')->take(3)->get();
        return view('index', ['artikel' => $artikelHome]);
    }
}
