<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class VentaController extends Controller
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
          return view('ventas.venta', compact('habitaciones', 'cont'));
       }
    }

    public function index_v($id)
    {
        $idreservacion    = DB::table('habitaciones_r')->select('idreservacion')->where('idhabitacion', '=', $id)->orderBy('idreservacion','desc')->first();
        $data['empresa']  = DB::table('empresa')->select('*')->orderBy('idempresa', 'desc')->first();

        $data['resepcion']= DB::table('habitaciones_r')->select('*')
                                ->join('habitaciones', 'habitaciones.idhabitacion','=', 'habitaciones_r.idhabitacion')
                                ->join('tipo_habitacion', 'tipo_habitacion.idtipo', 'habitaciones.idtipo')  
                                ->join('clientes', 'clientes.idcliente', '=', 'habitaciones_r.idcliente')
                                ->where('idreservacion', '=', $idreservacion->idreservacion)
                                ->first();
                                


        return view('ventas.vender', $data);
    }

    public function buscarproducto(Request $request)
    {
      $data        = $request->get('valor');
      $producto    = DB::table('producto')->select('*')->where('nombre', 'LIKE', '%'.$data.'%')
                    ->take(10)
                    ->get();
      $array= [];
      foreach ($producto as $productos)
      {
        $array[] = 
        [
         'label'          => $productos->nombre." | ".$productos->precio,
         'idproducto'     => $productos->idproducto,
         'precio'         => $productos->precio
        ];
      }
      return $array;

    }

    public function vender_save(Request $request)
    {
      if(!$request->ajax())
      {
           echo json_encode(['status' => false]);
           return;
      }

      $caja = DB::table('caja')->select('*')
      ->orderBy('caja.id', 'desc')
      ->first();

      $idreservacion = $request->post('idreservacion');
      $tablaProducto= json_decode($request->post('tabla_productos'));
      
      foreach ($tablaProducto as $tablaProductos)
      {
        foreach ($tablaProductos as $index => $valor)
        {
          if($valor[4]=='PENDIENTE')
          {
            $valor[4] = 2;
          }
          else
          {
            $valor[4] = 1;
            DB::table('caja')->update([
                  'actual' => $caja->actual+($valor[2]* $valor[3])

            ]);

          }

            $data = [
                'idreservacion' => $idreservacion,
                'idproducto'    => $valor[0],
                'cantidad'      => $valor[2],
                'precio'        => $valor[3],
                'estado'        => $valor[4],
                'fecha'         => date('Y-m-d'),
                'idusuario'     => $request->session()->get('idusuario')
              ];

            

            

            DB::table('reservacion_detalle')->insert($data);
            $stock    = DB::table('producto')->select('*')->where('idproducto', '=', $valor[0])->first();
            $restante = $stock->stock- $valor[2];
            DB::table('producto')->where('idproducto', '=', $valor[0])->update(['stock' => $restante]);



        }
      }

          echo json_encode(['status' => true,
        ]);

    }
}
