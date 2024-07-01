<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva_detalle;
use DB;

class SalidaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('login');
        }
        else
        {
            $habitaciones  = DB::table('habitaciones')->select('habitaciones.idhabitacion','habitaciones.numero', 'habitaciones.precio','niveles.denominacion as descripcion',
            'tipo_habitacion.denominacion as nombre', 'habitaciones.estado')
            ->join('niveles', 'niveles.idnivel', 'habitaciones.idnivel')
            ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')
            ->where('habitaciones.estado', '=', 1)
            ->get();

            $cont = count($habitaciones);
            
            return view('salidas.index', compact('habitaciones', 'cont'));
        }
        
       
    }
    
    public function salidas_v($id)
    {
        $idreservacion    = DB::table('habitaciones_r')->select('idreservacion')->where('idhabitacion', '=', $id)->orderBy('idreservacion','desc')->first();
        $data['empresa']  = DB::table('empresa')->select('*')->orderBy('idempresa', 'desc')->first();

        $data['resepcion']= DB::table('habitaciones_r')->select('*')
                                ->join('habitaciones', 'habitaciones.idhabitacion','=', 'habitaciones_r.idhabitacion')
                                ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')  
                                ->join('clientes', 'clientes.idcliente', '=', 'habitaciones_r.idcliente')
                                ->where('idreservacion', '=', $idreservacion->idreservacion)
                                ->first();

      
        
        if( $data['resepcion']->adelanto != null)
        {
            $data['total_habitacion']    = $data['resepcion']->monto - $data['resepcion']->adelanto;
        }
        else
        {
            $data['total_habitacion']    = 0;
        }
                                
       

         $data['detalle_reservacion'] = Reserva_detalle::select('*', 'reservacion_detalle.estado as estado_detalle')
        ->join('producto', 'producto.idproducto', '=', 'reservacion_detalle.idproducto')
        ->where('idreservacion', $idreservacion->idreservacion)
        ->get();
        
        $monto_total_productos = 0;
        foreach($data['detalle_reservacion'] as $detalles)
        {
            
                $monto = $detalles->cantidad * $detalles->precio;
                $monto_total_productos+= $monto;
        }

        $data['monto_detalles'] =  $monto_total_productos;



        //HABITACION + PRODUCTOS QUE FALTAN PAGAR

        $monto_total_total = 0;
        foreach($data['detalle_reservacion'] as $detalles)
        {
            if($detalles->estado_detalle == 2)
            {
                $monto = $detalles->cantidad * $detalles->precio;
                $monto_total_total+= $monto;
            }
        }
       
       $data['montoPagar'] =  $data['total_habitacion'] + $monto_total_total;


        return view('salidas.verificar', $data);
    }

    public function mora(Request $request)
    {
        $idreservacion = $request->post('idreservacion');
        $mora          = $request->post('mora');
        $monto_total   = $request->post('monto_total');
        if($mora!= 'NaN')
        {
            DB::table('habitaciones_r')->where('idreservacion', '=', $idreservacion)->update([
                'mora' => $mora,
                'total_pagado' => $monto_total
            ]);
        }
        else{
            DB::table('habitaciones_r')->where('idreservacion', '=', $idreservacion)->update([
                'mora' => null,
                'total_pagado' => $monto_total
            ]);
        }
        return;
        
      

        
    }
}
