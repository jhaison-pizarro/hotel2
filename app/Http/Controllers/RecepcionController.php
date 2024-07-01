<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reserva_detalle;
use PDF;


class RecepcionController extends Controller
{
    public function index(Request $request)
    {
       if(!$request->session()->get('usuario'))
       {
         return view('login');
       }
       else
       {
          $niveles       = DB::table('niveles')->select('*')->get(); 
          $habitaciones  = DB::table('habitaciones')->select('habitaciones.idhabitacion','habitaciones.numero', 'habitaciones.precio','niveles.denominacion as descripcion',
                        'tipo_habitacion.denominacion as nombre', 'habitaciones.estado')
                        ->join('niveles', 'niveles.idnivel', 'habitaciones.idnivel')
                        ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')
                        ->get();
          return view('recepcion.index',compact('niveles', 'habitaciones'));
       }
       
    } 
    public function habitaciones_niveles(Request $request)
    {
      if(!$request->ajax())
       {
            echo json_encode(['status' => false]);
            return;
       }

       $idnivel = $request->post('idnivel');
       if($idnivel != 0)
       {
          $habitaciones_nivel  = DB::table('habitaciones')->select('habitaciones.idhabitacion','habitaciones.numero', 'habitaciones.precio','niveles.denominacion as descripcion',
          'tipo_habitacion.denominacion as nombre', 'habitaciones.estado')
          ->join('niveles', 'niveles.idnivel', 'habitaciones.idnivel')
          ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')
          ->where('habitaciones.idnivel', '=', $request->post('idnivel'))
          ->get();
  
            echo json_encode([
            'status' => true,
            'habitaciones_nivel' => $habitaciones_nivel
          ]);
       }
       else
       {
          $habitaciones_nivel  = DB::table('habitaciones')->select('habitaciones.idhabitacion','habitaciones.numero', 'habitaciones.precio','niveles.denominacion as descripcion',
          'tipo_habitacion.denominacion as nombre', 'habitaciones.estado')
          ->join('niveles', 'niveles.idnivel', 'habitaciones.idnivel')
          ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')
          ->get();

            echo json_encode([
            'status' => true,
            'habitaciones_nivel' => $habitaciones_nivel
          ]);
       }
      
      
    }


    public function reservar_disponible($id)
    {
      
      $habitaciones  = DB::table('habitaciones')->select('habitaciones.idhabitacion','habitaciones.numero', 'habitaciones.precio','niveles.denominacion', 'habitaciones.descripcion',
      'tipo_habitacion.denominacion as nombre', 'habitaciones.estado')
      ->join('niveles', 'niveles.idnivel', 'habitaciones.idnivel')
      ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')
      ->where('idhabitacion', '=', $id)
      ->first();

      
   
      $tipo_documento = DB::table('tipo_documento')->get();
      return view('recepcion.atender', compact('habitaciones', 'tipo_documento'));
    }
   

    public function buscardni(Request $request)
    {
        $data   = $request->get('valor');
        $dni    = DB::table('clientes')->select('*')->where('dni', 'LIKE', '%'.$data.'%')
        ->take(10)
        ->get();

        $array= [];
        foreach ($dni as $dnis)
        {
          $array[] = [

            'label'          => $dnis->dni." | ".$dnis->nombre." ".$dnis->apellido,
            'idcliente'      => $dnis->idcliente,
            'nombre'         => $dnis->nombre,
            'apellido'       => $dnis->apellido,
            'telefono'       => $dnis->telefono,
            'email'          => $dnis->correo,
            'dni'            => $dnis->dni,


          ];
        }
        return $array;

    }

    public function save_resepcion(Request $request)
    {
        if(!$request->ajax())
        {
          echo json_encode([
            'status' => false,
          ]);

          return;
        }

        $idcliente       = $request->post('idcliente');
        $entrada         = $request->post('entrada');
        $salida          = $request->post('salida');
        $adelanto        = $request->post('adelanto');
        $precio          = $request->post('precio');
        $observacion     = $request->post('observaciones');
        $idhabitacion    = $request->post('idhabitacion');
        $dni             = $request->post('dni');
        $idtipo_documento= $request->post('idtipo_documento');
        $nombre          = $request->post('nombre');
        $apellido        = $request->post('apellido');
        $telefono        = $request->post('telefono');
        $correo          = $request->post('email');

        $data = [

             'idhabitacion' => $idhabitacion,
             'idcliente'    => $idcliente,
             'entrada'      => $entrada,
             'salida'       => $salida,
             'monto'        => (int)$precio,
             'observacion'  => $observacion,
             'adelanto'     => $adelanto,
             'fecha_registro'=> date('Y-m-d'),
             'idusuario'     => $request->session()->get('idusuario')
             
        ];

        
       

        
        DB::table('habitaciones_r')->insert($data);
        DB::table('habitaciones')->where('idhabitacion', '=', $idhabitacion)->update([ 'estado' => 1]);
       

        //Ultima habitacion registrada
        $hab_r = DB::table('habitaciones_r')->select('*')
        ->orderBy('habitaciones_r.idreservacion', 'desc')
        ->first();

        //Sacando ultima caja 
        $caja = DB::table('caja')->select('*')
        ->orderBy('caja.id', 'desc')
        ->first();

        if(empty($hab_r->adelanto))
        {
          DB::table('caja')->update([ 'actual' => $caja->actual + $hab_r->monto]);
        }
        else
        {
          DB::table('caja')->update([ 'actual' => $caja->actual + $hab_r->adelanto]);
        }
        return;

        echo json_encode([

          'status' => true,
        ]);


    }

    public function factura($id)
    {

        $data['empresa']  = DB::table('empresa')->select('*')->orderBy('idempresa', 'desc')->first();
        $data['resepcion']= DB::table('habitaciones_r')->select('*')
                                ->join('habitaciones', 'habitaciones.idhabitacion','=', 'habitaciones_r.idhabitacion')
                                ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')  
                                ->join('clientes', 'clientes.idcliente', '=', 'habitaciones_r.idcliente')
                                ->where('idreservacion', '=', $id)
                                ->first();
          $data['numero']   = str_pad($id, 7, '0', STR_PAD_LEFT);

        if( $data['resepcion']->mora == null)
        {
          $data['resepcion']->mora = 0;
        }
        else
        {
          $data['resepcion']->mora = $data['resepcion']->mora;
        }

        if( $data['resepcion']->adelanto == null)
        {
          $data['resepcion']->adelanto = 0;
        }
        else
        {
          $data['resepcion']->adelanto = $data['resepcion']->adelanto;
        }

        $data['montopagar'] = ($data['resepcion']->monto - $data['resepcion']->adelanto)  + $data['resepcion']->mora;
        
        $data['detalle_reservacion'] = Reserva_detalle::select('*', 'reservacion_detalle.estado as estado_detalle')
        ->join('producto', 'producto.idproducto', '=', 'reservacion_detalle.idproducto')
        ->where('idreservacion', $id)
        ->get();


        //MONTO TOTAL CONSUMO//
        $monto_total_pagado = 0;
        foreach($data['detalle_reservacion'] as $detalles)
        {
                $monto = $detalles->cantidad * $detalles->precio;
                $monto_total_pagado += $monto;
        }
        $data['monto_detalles'] =  $monto_total_pagado;
        
        //MONTO FALTA 
        $monto_total_falta = 0;
        foreach($data['detalle_reservacion'] as $detalles)
        {
               if($detalles->estado_detalle == 2)
               {
                  $monto = $detalles->cantidad * $detalles->precio;
                  $monto_total_falta += $monto;
               }
                
        }
        $data['monto_total_falta'] =  $monto_total_falta;

        //DINERO PAGADO

        $monto_total_pagado = 0;
        foreach($data['detalle_reservacion'] as $detalles)
        {
               if($detalles->estado_detalle == 1)
               {
                  $monto = $detalles->cantidad * $detalles->precio;
                  $monto_total_pagado += $monto;
               }
                
        }
        $data['monto_total_pagado'] =  $monto_total_pagado;

        //Actuazando caja//
        $caja = DB::table('caja')->select('*')
        ->orderBy('caja.id', 'desc')
         ->first();

       
        
        $_monto_r = DB::table('habitaciones_r')->where('idreservacion', $id)->first(); 

      

        DB::table('caja')->where('id', $caja->id)->update(['actual' => $caja->actual + $_monto_r->total_pagado]);
        DB::table('habitaciones')->where('idhabitacion', $data['resepcion']->idhabitacion)->update(['estado' => 0]);
        


        DB::table('habitaciones')->where('habitaciones.idhabitacion', $data['resepcion']->idhabitacion)->update(['estado' => 2]);
        return PDF::loadView('facturas.factura', $data)
        ->stream('archivo.pdf');


        
        

        
      
    }
}
