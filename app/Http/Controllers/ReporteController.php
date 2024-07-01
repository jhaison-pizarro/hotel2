<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reserva_detalle;
use PDF;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get('usuario'))
		{
			return view('login'); 
		}
        else 
        {
            return view('reportes.index');
        }
    }

    public function diario(Request $request)
    {
        $fecha   = $request->post('fecha_final');
        $tipo    = $request->post('tipo_servicio');

        if($tipo == 1)
        {
            $alquiler = DB::table('habitaciones_r')->select('*')
            ->join('habitaciones', 'habitaciones.idhabitacion','=', 'habitaciones_r.idhabitacion')
            ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')  
            ->join('clientes', 'clientes.idcliente', '=', 'habitaciones_r.idcliente')
            ->where('habitaciones_r.fecha_registro', '=', $fecha)
            ->get();
           
           
    
           
    
            return Datatables()
            ->of($alquiler)
             ->addColumn('dinero_adelantado', function($alquiler){
                if(!empty($alquiler->adelanto))
                {
                    $btn = '<p>S/ '.$alquiler->adelanto.'.00</p> ';
                    return $btn;
                }
                    $btn = '<p>No tiene</p> ';
                    return $btn;
              
                
            })
            ->addColumn('monto_real', function($alquiler){
                
                $btns = '<p>S/ '.$alquiler->monto.'.00</p> ';
                return $btns;
              
                
            })
            ->addColumn('pendiente_pago', function($alquiler){
                
                if(!empty($alquiler->adelanto))
                {
                    $monto = (($alquiler->monto) - ($alquiler->adelanto));
                    $pen = '<p>S/ '.$monto.'.00</p> ';
                    return $pen;
                   
                }
                $pen = '<p>S/ '.$alquiler->monto.'.00</p> ';
                return $pen;
              
                
            })
            ->addColumn('mora', function($alquiler){
                
                if(!empty($alquiler->mora))
                {
                    $mora = $alquiler->mora;
                    $pens = '<p>S/ '.$mora.'.00</p> ';
                    return $pens;
                   
                }
                $pens = '<p>S/ 0.00</p> ';
                return $pens;
              
                
            })
            ->addColumn('subtotal', function($alquiler){
                
                if(empty($alquiler->mora) & empty($alquiler->adelanto))
                {
                    $montos = $alquiler->monto;
                    $total = '<p>S/ '.$montos.'.00</p> ';
                    return $total;
                   
                }
                $monto_total = ($alquiler->monto + $alquiler->mora)-$alquiler->adelanto;
                $total = '<p>S/ '.$monto_total.'.00</p> ';
                return $total;
              
                
            })
    
            ->rawColumns(['dinero_adelantado', 'monto_real','pendiente_pago', 'mora', 'subtotal'])
            ->make(true);
        }
       
  

       


       
    }

    public function buscar_detalles(Request $request)
    {
        $fecha   = $request->post('fecha');
        $detalle = Reserva_detalle::select('*', 'reservacion_detalle.estado as estado_detalle', 'reservacion_detalle.cantidad as cant_produc', 'reservacion_detalle.fecha as fechaventa', 'producto.nombre as producto_det')
        ->join('producto', 'producto.idproducto', '=', 'reservacion_detalle.idproducto')
        ->join('usuarios', 'usuarios.idusuario', '=', 'reservacion_detalle.idusuario')
        ->where('reservacion_detalle.fecha', $fecha)
        ->get();

        

       
        $monto_subtotal = 0;
        foreach($detalle as $detalles)
        {
              
               $monto = $detalles->cantidad * $detalles->precio;
               $monto_subtotal += $monto;
        }

        $monto_pagado = 0;
        foreach($detalle as $detalles)
        {
               if($detalles->estado_detalle == 1)
               {
                  $monto = $detalles->cantidad * $detalles->precio;
                  $monto_pagado += $monto;
               }
                
        }
        $monto_falta = 0;
        foreach($detalle as $detalles)
        {
               if($detalles->estado_detalle == 2)
               {
                  $monto = $detalles->cantidad * $detalles->precio;
                  $monto_falta += $monto;
               }
                
        }

    
      

        echo json_encode([

            'status' => true,
            'detalle' => $detalle,
            'monto' => $monto_subtotal,
            'monto_pagado' => $monto_pagado,
            'monto_falta' => $monto_falta
        ]);

        

      

    }
    public function report_pdf($fecha)
    {
        
        $detalle = Reserva_detalle::select('*', 'reservacion_detalle.estado as estado_detalle', 'reservacion_detalle.cantidad as cant_produc', 'reservacion_detalle.fecha as fechaventa', 'producto.nombre as producto_det')
        ->join('producto', 'producto.idproducto', '=', 'reservacion_detalle.idproducto')
        ->join('usuarios', 'usuarios.idusuario', '=', 'reservacion_detalle.idusuario')
        ->where('reservacion_detalle.fecha', $fecha)
        ->get();

        $monto_subtotal = 0;
        foreach($detalle as $detalles)
        {
              
               $monto = $detalles->cantidad * $detalles->precio;
               $monto_subtotal += $monto;
        }

        $monto_pagado = 0;
        foreach($detalle as $detalles)
        {
               if($detalles->estado_detalle == 1)
               {
                  $monto = $detalles->cantidad * $detalles->precio;
                  $monto_pagado += $monto;
               }
                
        }
        $monto_falta = 0;
        foreach($detalle as $detalles)
        {
               if($detalles->estado_detalle == 2)
               {
                  $monto = $detalles->cantidad * $detalles->precio;
                  $monto_falta += $monto;
               }
                
        }


        return PDF::loadView('reportes.pdf', compact('detalle', 'fecha', 'monto_falta', 'monto_pagado', 'monto_subtotal' ))
        ->setPaper('a4', 'landscape')
        ->stream('archivo.pdf');

        
    }
}
