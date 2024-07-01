<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NivelesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->session()->get('usuario'))
      {
        return view('login');
      }
      else
      {
        
        return view('niveles.index');

      }
    }

    public function niveles_table(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }
        $niveles  = DB::table('niveles')->get();
        return Datatables()
        ->of($niveles)
        ->addColumn('acciones', function ($niveles)
            {
                $idnivel = $niveles->idnivel;
                $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_nivel" data-id="'.$idnivel.'"><i class="fa fa-edit text-warning"></i></a> <a style="font-size:20px"  type="button" class="btn-delete_nivel" data-id="'.$idnivel.'"><i class="fa fa-trash text-danger"></i></a>'
                          ;
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);

    }

    public function save_nivel(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }

        $denominacion = $request->post('denominacion');
        DB::table('niveles')->insert(['denominacion' => $denominacion]);
        echo json_encode([

            'status' => true
        ]);


        
    }

    public function edit_nivel(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }

        $idnivel = $request->post('idnivel');
        $niveles = DB::table('niveles')->select('*')->where('idnivel',$idnivel)->first();
        echo json_encode([
            'status' => true,
            'niveles' => $niveles
        ]);

       
    }

    public function update_nivel(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }

        $idnivel        = $request->post('idnivel');
        $denominacion   = $request->post('denominacion');
        DB::table('niveles')->where('idnivel',$idnivel)->update([

            'denominacion' => $denominacion
        ]);

        echo json_encode([

            'status' => true
        ]);
    }

    public function delete_nivel(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => true
            ]);
            return;
        }

        $idnivel = $request->post('idnivel');

        DB::table('niveles')->where('idnivel',$idnivel)->delete();
        echo json_encode([
            'status' => true
        ]);
        return;
    }
}
