<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Noticia;
    
class MainController extends Controller
{
   public function index(): View
    {
        $noticias = Noticia::with('comentarios')->latest()->get();
        return view('index', compact('noticias'));
    }
}