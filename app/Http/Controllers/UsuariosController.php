<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsuariosController extends Controller
{
       public function usuarios(Request $request)
       { 
            //Si no hay session se redirige al login
            if(!$request->session()->get('usuario'))
            {
                return view('login');
            }
            else
            {
                $roles = DB::table('roles')->where('estado', 0)->get();
                return view('usuarios.usuarios', compact('roles'));
            }
       
       }

       public function usuarios_tabla(Request $request)
       {
            $usuarios = DB::table('usuarios')->select('*')->orderBy('idusuario', 'DESC')->get();

           
            return Datatables()
            ->of($usuarios)
            ->addColumn('acciones', function ($usuarios)
            {
                $idusuario = $usuarios->idusuario;
                $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_usuario" data-id="'.$idusuario.'"><i class="fa fa-edit text-warning"></i></a>
                            <a style="font-size:20px" type="button" class="btn_delete_usuario" title="Ver contrata" data-id="'.$idusuario.'"><i class="fa fa-trash f-16 text-danger"></i></a>';
                return $btn;
            })
            ->addColumn('estado', function($usuarios)
            {
                if($usuarios->estado == '0')
                {
                    $estado ='<span class="label label-success" style="font-size:13px">Activo</span> ';
                    return $estado;
                }
                if($usuarios->estado == '1')
                {
                    $estado ='<span class="label label-danger" style="font-size:13px">Inactivo</span> ';
                }
                
                return $estado;
            })
            ->rawColumns(['acciones', 'estado'])
            ->make(true);

       }

       public function save_usuarios(Request $request)
       {
          $nombre       = $request->post('nombre');
          $documento    = $request->post('documento');
          $telefono     = $request->post('telefono');
          $direccion    = $request->post('direccion');
          $usuario      = $request->post('usuario');
          $contraseña   = $request->post('contraseña');
          $idrol        = $request->post('idrol');
          $estado       = 0;

          DB::table('usuarios')->insert([
                'usuario'   => $usuario,
                'documento' => $documento,
                'telefono'  => $telefono,
                'direccion' => strtoupper($direccion),
                'nombre'    => strtoupper($nombre),
                'contraseña'=> $contraseña,
                'idrol'     => $idrol,
                'estado'    => $estado,

          ]);

          echo json_encode([
            'status'        => true,
            
            ]);
    

       }

       public function edit_usuario(Request $request)
       {    
            $idusuario = $request->post('id');
            $usuario = DB::table('usuarios')->select('*')->where('idusuario', $idusuario)->first();
            echo json_encode([
                'status'        => true,
                'usuario'       => $usuario
                
                ]);
       }

       public function update_usuario(Request $request)
       {
            $nombre       = $request->post('nombre');
            $documento    = $request->post('documento');
            $telefono     = $request->post('telefono');
            $direccion    = $request->post('direccion');
            $usuario      = $request->post('usuario');
            $contraseña   = $request->post('contraseña');
            $idusuario    = $request->post('idusuario');
            $idrol        = $request->post('idrol');
            $estado       = 0;


           

            DB::table('usuarios')->where('idusuario', '=', $idusuario)->update([
                'usuario'   => $usuario,
                'documento' => $documento,
                'telefono'  => $telefono,
                'direccion' => strtoupper($direccion),
                'nombre'    => strtoupper($nombre),
                'contraseña'=> $contraseña,
                'idrol'     =>$idrol,
                
                'estado'    => $estado,
          ]);

          echo json_encode([
            'status'        => true,

            ]);
    

       }

       public function delete_usuarios(Request $request)
       {
         $idusuario  = $request->post('id');
         DB::table('usuarios')->where('idusuario', $idusuario)->update([
            'estado' => 1
         ]);
         echo json_encode([
                'status' => true,
         ]);

       }
    }
