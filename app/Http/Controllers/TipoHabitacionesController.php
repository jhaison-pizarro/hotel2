<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TipoHabitacionesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('login'); 
        }
        else
       {
         
          return view('tipo_habitaciones.index');
       }
    }


    public function tipo_habitaciones_table(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }
        $tipo_habitaciones = DB::table('tipo_habitacion')->get();
        return Datatables()
        ->of($tipo_habitaciones)
        ->addColumn('acciones', function ($tipo_habitaciones)
            {
                $idtipo = $tipo_habitaciones->idtipo;
                $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_tipo_habitacion" data-id="'.$idtipo.'"><i class="fa fa-edit text-warning"></i></a> <a style="font-size:20px"  type="button" class="btn_delete_tipohabitacion" data-id="'.$idtipo.'"><i class="fa fa-trash text-danger"></i></a>
                          ';
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function save_tipo_habitacion(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }
        $denominacion   = $request->post('denominacion');
        $descripcion    = $request->post('descripcion');
        DB::table('tipo_habitacion')->insert([
                'denominacion' => $denominacion,
                'descripcion' => $descripcion
        ]);

        echo json_encode([
            'status' => true
        ]);
    }

    public function edit_tipo_habitacion(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }
        $idtipo  = $request->post('idtipo');
        $edit_tipo = DB::table('tipo_habitacion')->select('*')->where('idtipo', $idtipo)->first();

        echo json_encode([

            'status' => true,
            'edit_tipo' => $edit_tipo
        ]);
    }

    public function update_tipo_habitacion(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }
        $denominacion = $request->post('denominacion');
        $descripcion  = $request->post('descripcion');
        $idtipo       = $request->post('idtipo');

        DB::table('tipo_habitacion')->where('idtipo', $idtipo)->update([

             'denominacion' => $denominacion,
             'descripcion' => $descripcion,
        ]);

        echo json_encode([

                'status' => true
        ]);
    }

    public function delete_tipo_habitacion(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }
        
        $idtipo = $request->post('idtipo');
        DB::table('tipo_habitacion')->where('idtipo', $idtipo)->delete();
        echo json_encode([

            'status' => true
        ]);
    }
}
