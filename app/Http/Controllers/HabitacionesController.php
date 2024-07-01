<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HabitacionesController extends Controller
{
    public function habitaciones(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('login'); 
        }
        else
       {
         $tipo_habitacion = DB::table('tipo_habitacion')->get();
         $niveles         = DB::table('niveles')->get();
          return view('habitaciones.index',compact('tipo_habitacion', 'niveles'));
       }
    }

    public function habitaciones_table(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }

        $habitaciones  = DB::table('habitaciones')->select('habitaciones.idhabitacion','habitaciones.numero', 'habitaciones.precio','niveles.denominacion as descripcion',
                        'tipo_habitacion.denominacion as nombre', 'habitaciones.estado')
                        ->join('niveles', 'niveles.idnivel', 'habitaciones.idnivel')
                        ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')
                        ->get();
        return Datatables()
        ->of($habitaciones)
        ->addColumn('acciones', function ($habitaciones)
            {
                $idhabitacion = $habitaciones->idhabitacion;
                $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_nivel" data-id="'.$idhabitacion.'"><i class="fa fa-edit text-warning"></i></a> <a style="font-size:20px"  type="button" class="btn-delete_nivel" data-id="'.$idhabitacion.'"><i class="fa fa-trash text-danger"></i></a>';
                          
                return $btn;
            })
            ->addColumn('estado', function($habitaciones)
            {
                if($habitaciones->estado == '0')
                {
                    $estado ='<span class="label label-success" style="font-size:13px">DISPONIBLE</span> ';
                    return $estado;
                }
                if($habitaciones->estado == '1')
                {
                    $estado ='<span class="label label-danger" style="font-size:13px">OCUPADO</span> ';
                    return $estado;
                }
                if($habitaciones->estado == '2')
                {
                    $estado ='<span class="label label-primary" style="font-size:13px">LIMPIEZA</span> ';
                    return $estado;
                }
                
                return $estado;
            })
            ->rawColumns(['acciones', 'estado'])
            ->make(true);
    }

    public function save_habitaciones(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }

        $numero      = $request->post('nro_habitacion');
        $precio      = $request->post('precio');
        $nivel       = $request->post('nivel');
        $tipo        = $request->post('tipo');
        $descripcion = $request->post('descripcion_hab');
       

        DB::table('habitaciones')->insert([

            'numero'        => $numero,
            'precio'        => $precio,
            'idnivel'       =>$nivel,
            'idtipo'        => $tipo,
            'descripcion'   => $descripcion,
            'estado'        => 0
        ]);

        echo json_encode([
            'status' => true
        ]);

    }

    public function limpieza(Request $request)
    {
       $idhabitacion = $request->post('idhabitacion');
       DB::table('habitaciones')->where('idhabitacion', $idhabitacion)->update(['estado' => 0]);
       echo json_encode([
           'status' => true
       ]);

    }
}
