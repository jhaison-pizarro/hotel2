<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\sendMail;
use Illuminate\Support\Facades\Mail; 

class reservarclController extends Controller
{
    public function reservar_cli(Request $request)
    {
        $huesped  = $request->post('huesped');
        $fecha_i  = $request->post('fecha_i');
        $fecha_f  = $request->post('fecha_f');
        $tipo     = $request->post('tipo');
        $correo   = $request->session()->get('correo');
        $nombre   = $request->session()->get('nombre');
        $apellido = $request->session()->get('apellido');
        

        $data_mail = [

            'huesped'   => $huesped,
            'fecha_i'   => $fecha_i,
            'fecha_f'   => $fecha_f,
            'tipo'      => $tipo,
            'nombre'    => $nombre,
            'apellido'  => $apellido
         ];

         Mail::to($correo)->send(new sendMail($data_mail));
         echo json_encode(['status' => true,]);



    }
}
