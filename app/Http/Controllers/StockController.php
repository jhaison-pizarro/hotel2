<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    public function verstock(Request $request)
    {
        if(!$request->ajax())
        {
           echo json_encode(['status' => false]);
           return;
        }

        $cantidad   = (int) $request->post('cantidad');
        $idproducto = $request->post('idproducto');

        $cantidadStock = DB::table('producto')->select('*')->where('idproducto', $idproducto)->first();
        if($cantidad >  $cantidadStock->stock)
        {
            echo json_encode(['status' => false,
            ]);
            return;
        }

        echo json_encode([
            'status'    => true
        ]);
    }

    public function notifi_stock(Request $request)
    {
        $productos = DB::table('producto')->get();
        $array= [];
        foreach($productos as $productos)
        {
            if($productos->stock < 10)
            {
                $array[] = 
                [
                 'nombre'          => $productos->nombre
                ];
            }
        }

        echo json_encode([
            'status' => true,
            'data'   => $array
        ]);
        
    }
}
