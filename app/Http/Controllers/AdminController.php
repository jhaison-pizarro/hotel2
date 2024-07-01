<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        
        return view('pagina_web.index');

    }
    public function session(Request $request)
    {
        return view('login');
    }

    public function paneladmin(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('pagina_web.index');
        }

           $habitaciones_ocupadas = DB::table('habitaciones')->where('estado', '=', 1)->get();
           $habitaciones_total    = DB::table('habitaciones')->get();
           $habitaciones_libres   = DB::table('habitaciones')->where('estado', '=', 0)->get();
           $habitaciones_limpieza = DB::table('habitaciones')->where('estado', '=', 2)->get();

             $caja = DB::table('caja')->select('*', 'caja.estado as estados')
            ->join('usuarios', 'usuarios.idusuario', 'caja.idusuario')
            ->orderBy('caja.id', 'desc')
            ->first();
           
        

            
         

            $data['total']          = count($habitaciones_total);
            $data['ocupadas']       = count($habitaciones_ocupadas);
            $data['libres']         = count($habitaciones_libres);
            $data['limpieza']       = count($habitaciones_limpieza);
            $data['caja']           = $caja;





           return view('paneladmin.panel', $data );

    }

    public function session_cli(Request $request)
    {
        
    }
}
