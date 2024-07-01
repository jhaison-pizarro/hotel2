<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('login');
        }
        else
        {
            return view('caja.index');
        }
    }

    public function save(Request $request)
    {

    


        $fecha   = $request->post('fecha');
        $hora    = $request->post('hora');
        $monto   = $request->post('monto');
        $idusuario= $request->session()->get('idusuario');

     

        DB::table('caja')->insert([

            'fecha'     => $fecha,
            'hora'      => $hora,
            'monto'     => $monto,
            'idusuario' => $idusuario,
            'actual'    => $monto,
            'estado'     =>1
        ]);

        echo json_encode([

             'status' => true,
        ]);
    }

    public function cajas_table(Request $request)
    {
        $caja = DB::table('caja')->select('*', 'caja.estado as estados')
        ->join('usuarios', 'usuarios.idusuario', 'caja.idusuario')
        ->orderBy('caja.id', 'desc')
        ->get();
        

        return Datatables()
        ->of($caja)
        ->addColumn('acciones', function ($caja)
                        {
                            $idcaja = $caja->id;
                            $btn       = '<a style="font-size:20px" title="Cerrar caja"  type="button" class="btn_cerrar_caja" data-id="'.$idcaja.'"><i class="fa fa fa-window-close-o text-success"></i></a>';
                            return $btn;
                        })
         ->addColumn('estado', function($caja)
            {
                if($caja->estados == '1')
                {
                    $estado ='<span class="label label-success" style="font-size:12px">Abierto</span> ';
                    return $estado;
                }
                if($caja->estados == '2')
                {
                    $estado ='<span class="label label-danger" style="font-size:12px">Cerrado</span> ';
                }
                
                return $estado;
            })
            

        ->rawColumns(['acciones', 'estado'])
        ->make(true);
       
    }

    public function cerrar_caja(Request $request)
    {
        $idcaja = $request->post('id');
        DB::table('caja')
        ->where('id', '=', $idcaja)
        ->update([
            'estado' => 2
        ]);

        echo json_encode([

             'status' => true,
        ]);
    }
}
