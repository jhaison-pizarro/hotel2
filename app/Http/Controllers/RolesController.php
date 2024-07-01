<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RolesController extends Controller
{
    public function roles(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
          return view('login');
        }
        else
        {
          
          return view('roles.index');
  
        }
    }

    public function table_roles(Request $request)
    {
         $roles = DB::table('roles')->orderBy('id', 'DESC')->get();

         return Datatables()
         ->of($roles)
         ->addColumn('acciones', function($roles){
          $id = $roles->id;
                $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_roles" data-id="'.$id.'"><i class="fa fa-edit text-warning"></i></a>
                            <a style="font-size:20px" type="button" class="btn_delete_roles" title="Ver contrata" data-id="'.$id.'"><i class="fa fa-trash f-16 text-danger"></i></a>';
                return $btn;
         })
         ->addColumn('estado', function($roles)
         {
             if($roles->estado == '0')
             {
                 $estado ='<span class="label label-success" style="font-size:13px">Activo</span> ';
                 return $estado;
             }
             if($roles->estado == '1')
             {
                 $estado ='<span class="label label-danger" style="font-size:13px">Inactivo</span> ';
             }
             
             return $estado;
         })
         ->rawColumns(['acciones','estado'])
         ->make(true);

    }
    public function save_roles(Request $request)
    {
      $descripcion = $request->post('descripcion');
      DB::table('roles')->insert([
        'descripcion' => $descripcion
      ]);
      echo json_encode([
        'status' => true
      ]);

    }

    public function edit_rol(Request $request)
    {
      $id = $request->post('id');
      $rol = DB::table('roles')->select('*')->where('id', $id)->first();
      echo json_encode([

        'status' =>true,
        'rol'    =>$rol
      ]);
  

    }

    public function update_rol(Request $request)
    {
      $id          = $request->post('id');
      $descripcion = $request->post('descripcion');
      DB::table('roles')->where('id', $id)->update([
           
        'descripcion' => $descripcion
      ]);
       echo json_encode([
        'status' => true
       ]);
    }

    public function delete_rol(Request $request )
    {
      $id = $request->post('id');
      DB::table('roles')->where('id', $id)->update([
          'estado' => 1,
      ]);
      echo json_encode([
        'status' => true
      ]);
    }
  
}
