<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
   public function index(Request $request)
   {
        if(!$request->session()->get('usuario'))
        {
            return view('login'); 
        }
        else
        {
            $eventos        = DB::table('eventos')->get();
            $habitaciones   = DB::table('habitaciones_r')->select('*')
            ->join('habitaciones', 'habitaciones.idhabitacion','=', 'habitaciones_r.idhabitacion')
            ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')  
            ->join('clientes', 'clientes.idcliente', '=', 'habitaciones_r.idcliente')
            ->get();
            
            return view('calendario.index', compact('eventos', 'habitaciones'));
        }
   }

   public function save_event(Request $request)
   {
       $val     = $request->post('val');
       $color   = $request->post('color');
       $fecha_i = $request->post('fecha_i');
       $fecha_f = $request->post('fecha_f');
       

       DB::table('eventos')->insert([
         'descripcion' => $val,
         'color'       => $color,
         'fecha_i'     => $fecha_i,
         'fecha_f'     => $fecha_f
       ]);

       echo json_encode([
            'status' => true
       ]);

   }

   public function delete_event(Request $request)
   {
         $id = $request->post('id');
         DB::table('eventos')->where('id', $id)->delete();
         echo json_encode([
            'status' => true
         ]);
   }
}
