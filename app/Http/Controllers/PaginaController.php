<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function pagina_index (Request $request)
    {
        return view('pagina_web.index');
    }
}
