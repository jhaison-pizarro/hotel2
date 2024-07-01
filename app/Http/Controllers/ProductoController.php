<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    public function productos_index(Request $request)
    {
      if(!$request->session()->get('usuario'))
      {
        return view('login');
      }
      else
      {
        $categorias = DB::table('categoria')->select('*')->get();
        return view('productos.index')->with('categorias', $categorias);

      }
    }

    public function productos_table(Request $request)
    {
        $producto = DB::table('producto')->select('producto.idproducto', 'producto.nombre', 'producto.precio', 'producto.stock', 'producto.fecha', 'producto.estado as estadopro', 'categoria.denominacion')
                    ->join('categoria', 'categoria.idcategoria', '=', 'producto.idcategoria')
                    ->orderBy('idproducto', 'DESC')
                    ->get();

      

         return Datatables()
        ->of($producto)
        ->addColumn('acciones', function($producto)
        {
            $idproducto = $producto->idproducto;
            $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_producto" data-id="'.$idproducto.'"><i class="fa fa-edit text-warning"></i></a>
                            <a style="font-size:20px" type="button" class="btn_delete_producto" title="Ver contrata" data-id="'.$idproducto.'"><i class="fa fa-trash f-16 text-danger"></i></a>';
            return $btn;
        })
        ->addColumn('progreso', function($producto)
            {
               if($producto->stock <= 10)
               {
                $progreso ='<span class="label label-danger" style="font-size:13px">'.$producto->stock.'</span> ';
                return $progreso;
               }
               if($producto->stock > 10)
               {
                $progreso ='<span class="label label-success" style="font-size:13px">'.$producto->stock.'</span> ';
               }
               return $progreso;
            })
            ->rawColumns(['acciones', 'progreso'])
            ->make(true);
    }



    public function save_producto(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                    'status'=> false
            ]);
            return;
        }

        $nombre   = strtoupper($request->post('nombre'));
        $precio   = $request->post('precio');
        $stock    = $request->post('stock');
        $categoria= $request->post('categoria');
        $fecha    = $request->post('fecha');
        $data     = 
        [

                'nombre'    => $nombre,
                'precio'    => $precio,
                'stock'     => $stock,
                'idcategoria' => $categoria,
                'fecha'     => $fecha,
                'estado'    => 0,
        ];

        DB::table('producto')->insert($data);

        echo json_encode([
            'status' => true,

        ]);

    }

    public function edit_producto(Request $request)
    {
        if(!$request->ajax())
        {
          echo json_encode([
             'status' => false
          ]);
          return;
        }

        else
        {
          $producto = DB::table('producto')->select('*')->where('idproducto', '=', $request->post('idproducto'))->first();
          echo json_encode([

            'status' => true,
            'producto' => $producto
          ]);
                   
        }
    }

    public function update_producto(Request $request)
    {
        
      if(!$request->ajax())
        {
          echo json_encode([
            'status' => false
          ]);
          return;
        }
        else
        {
         
          $nombre     = strtoupper($request->post('nombre'));
          $precio     = $request->post('precio');
          $stock      = $request->post('stock');
          $categoria  = $request->post('categoria');
          $fecha      = $request->post('fecha');
          $estado     = 0;
          $data       = 
          [
              'nombre'      => $nombre,
              'precio'      => $precio,
              'stock'       => $stock,
              'idcategoria' => $categoria,
              'fecha'       => $fecha,
              'estado'      => $estado,
          ];

          DB::table('producto')->where('idproducto', '=', $request->post('idproducto'))->update($data);

          echo json_encode([
           'status' => true,

          ]);
        }
    }
  
    public function delete_producto(Request $request)
    {
      if(!$request->ajax())
      {
        echo json_encode([
         'status' => false
        ]);
        return;
      }
      else
      {
        DB::table('producto')->where('idproducto', '=', $request->post('idproducto'))->delete();
        echo json_encode([
         'status' => true,

        ]);
      }
    }
}
