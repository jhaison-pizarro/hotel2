<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        
        if(!$request->session()->get('usuario'))
        {
            return view('login');
        }
        else
        {
            
            $empresa = DB::table('empresa')->select('*')->orderBy('idempresa', 'desc')->first();
            return view('empresa.index')->with('empresa', $empresa);

        }
       
    }

    public function save_empresa(Request $request)
    {

        if(!$request->ajax())
        {
            echo json_encode(['status' => false]);
            return;
        }

    
       $nombre    = $request->post('nombre_empresa');
       $direccion = $request->post('direccion_empresa');
       $telefono  = $request->post('telefono_empresa');
       $correo    = $request->post('email_empresa');
       $ruc       = $request->post('ruc_empresa');
       $web       = $request->post('web_empresa');
       $logo      = $request->file('logo_empresa');
       
       if(empty($logo))
       {
            echo json_encode(['status' => false]);
            return;
       }

        $logo->move(public_path('logo_empresa'), $logo->getClientOriginalName()); 
        $data = [

       
         'nombre'       => $nombre,
         'ruc'          => (int)$ruc,
         'telefono'     => $telefono,
         'correo'       => $correo,
         'web'          => $web,
         'direccion'    => $direccion,
         'logo'         => $logo->getClientOriginalName()
         
       ];
       DB::table('empresa')->insert([$data]);

       //Extrayendo datos
      
       
    }
}
