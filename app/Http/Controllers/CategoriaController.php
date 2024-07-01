<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoriaController extends Controller
{
    public function categorias_index(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('login');
        }
        else
        {
            return view('categorias.categorias');
        }
    }

    public function categorias_table(Request $request)
    {
        $categorias = DB::table('categoria')->select('*')->orderBy('idcategoria', 'DESC')->get();
    

        return Datatables()
        ->of($categorias)
        ->addColumn('acciones', function($categorias)
        {
            $idcategoria = $categorias->idcategoria;
            $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_categoria" data-id="'.$idcategoria.'"><i class="fa fa-edit text-warning"></i></a>
                            <a style="font-size:20px" type="button" class="btn_delete_categoria" title="Ver contrata" data-id="'.$idcategoria.'"><i class="fa fa-trash f-16 text-danger"></i></a>';
                return $btn;

        })
        ->addColumn('estado', function($categorias)
            {
                if($categorias->estado == '0')
                {
                    $estado ='<span class="label label-success" style="font-size:13px">Activo</span> ';
                    return $estado;
                }
                if($categorias->estado == '1')
                {
                    $estado ='<span class="label label-danger" style="font-size:13px">Inactivo</span> ';
                }
                
                return $estado;
            })
        ->rawColumns(['acciones', 'estado'])
        ->make(true);
    }

    public function save_categoria(Request $request)
    {
       if(!$request->ajax())
       {
            echo json_encode(['status' => false]);
            return;
       }

        $denominacion = strtoupper($request->post('denominacion'));
        DB::table('categoria')->insert([
            'denominacion' => $denominacion,
            'estado'       => 0
        ]);

        echo json_encode(['status' =>true]);
    }

    public function edit_categoria(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['status' => false]);
            return;
        }

       $idcategoria = $request->post('id');
       $categorias  = DB::table('categoria')->select('*')->where('idcategoria',$idcategoria)->first();

       echo json_encode([
          'status' => true,
          'categoria' => $categorias
       ]);
    }

    public function update_categoria(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['status' => false]);
            return;   
        }

        
        $denominacion = strtoupper($request->post('denominacion'));
        $idcategoria  = $request->post('idcategoria');

        DB::table('categoria')->where('idcategoria', $idcategoria)->update(['denominacion' => $denominacion,
                                                                            'estado'=>0
                                                                            ]);
        echo json_encode([
            'status' => true,

        ]);
    }

    public function delete_categoria(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode(['status' => false]);
            return;   
        }

        $idcategoria = $request->post('idcategoria');
        DB::table('categoria')->where('idcategoria', $idcategoria)->update(['estado' => 1]);
        echo json_encode(['status' => true]);
    }
}
