<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ClientesController extends Controller
{
    public function clientes_index(Request $request)
    {
        if(!$request->session()->get('usuario'))
        {
            return view('login');
        }
        else
        { 

            $tipo_documento = DB::table('tipo_documento')->get();
            return view('clientes.index', compact('tipo_documento'));
        }
    }

    public function clientes_table(Request $request)
    {
        $clientes  = DB::table('clientes')->select('*')
                    ->join('tipo_documento', 'tipo_documento.idtipo_documento', 'clientes.idtipo_documento')
                    ->orderBy('clientes.idcliente', 'DESC')
                    ->get();

                    return Datatables()
                    ->of($clientes)
                    ->addColumn('acciones', function ($clientes)
                        {
                            $idcliente = $clientes->idcliente;
                            $btn       = '<a style="font-size:20px"  type="button" class="btn-edit_cliente" data-id="'.$idcliente.'"><i class="fa fa-edit text-warning"></i></a> <a style="font-size:20px"  type="button" class="btn-delete_cliente" data-id="'.$idcliente.'"><i class="fa fa-trash text-danger"></i></a>';
                                      
                            return $btn;
                        })
                       
                        ->rawColumns(['acciones'])
                        ->make(true);
    }



    public function save_cliente(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([

                'status' => false
            ]);
        }

        $nombre      = $request->post('nombre');
        $apellido    = $request->post('apellido');
        $correo      = $request->post('correo');
        $telefono    = $request->post('telefono');
        $direccion   = $request->post('direccion');
        $idtipo_documento = $request->post('tipo_doc');
        $dni          = $request->post('dni');

     

        

        DB::table('clientes')->insert([

            'nombre'   => $nombre,
            'apellido' => $apellido,
            'correo'   => $correo,
            'direccion'=> $direccion,
            'telefono' => $telefono,
            'idtipo_documento' => $idtipo_documento,
            'dni'      => $dni,
            'estado'   => 0
            
        ]);

        echo json_encode([
             'status' => true
        ]);

    }

    public function edit_cliente(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => false
            ]);
        }

        $idcliente = $request->post('idcliente');
       

     

        $clientes_datos = DB::table('clientes')->select('clientes.idcliente', 'nombre', 'apellido', 'tipo_documento.descripcion', 'clientes.idtipo_documento', 'clientes.dni', 'clientes.correo', 'clientes.telefono', 'clientes.direccion')
                          ->join('tipo_documento','tipo_documento.idtipo_documento', '=', 'clientes.idtipo_documento')
                          ->where('clientes.idcliente', '=', $idcliente)
                          ->first();

        echo json_encode([

                'status' => true,
                'clientes' => $clientes_datos
        ]);

        
    }

    public function save_edit_clientes(Request $request)
    {

        if(!$request->ajax())
        {
            echo json_encode([
                'status' => false,
            ]);
        }
        $nombre     = $request->post('nombre');
        $apellido   = $request->post('apellido');
        $idtipo_doc = $request->post('idtipo_doc');
        $dni        = $request->post('dni');
        $correo     = $request->post('correo');
        $telefono   = $request->post('telefono');
        $idcliente  = $request->post('idcliente');

        $data = [

                'nombre'            => $nombre,
                'apellido'          => $apellido,
                'idtipo_documento'  => $idtipo_doc,
                'dni'               => $dni,
                'correo'            => $correo,
                'telefono'          => $telefono,
               
            ];

        DB::table('clientes')->where('idcliente', $idcliente)->update($data);

        echo json_encode([

                'status' => true
        ]);

    }

    public function delete_cliente(Request $request)
    {
        if(!$request->ajax())
        {
            echo json_encode([

                'status' => false
            ]);
        }

        $idcliente  = $request->post('idcliente');
        DB::table('clientes')->where('idcliente', '=', $idcliente)->delete();

        echo  json_encode([

                'status' => true
        ]);
    }

    public function btn_reniec_cli(Request $request)
    {
        if(!$request->ajax()) {
            echo json_encode([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
            return;
        }
        $dni_ruc = $request->post('dni_ruc');
        $dni_ruc            = trim($request->input('dni_ruc'));
        if(empty($dni_ruc)) {
            echo json_encode([
                'status'    => false,
                'msg'       => 'Ingrese un número de documento',
                'type'      => 'warning'
            ]);
            return;
        }

        if(strlen($dni_ruc) == 8 || strlen($dni_ruc) == 11) {
            $client             = $this->buscar_reniec($dni_ruc);

           

            if($client->status == 404)
            {
                echo json_encode([
                    'status'    => false,
                    'msg'       => $client->message,
                    'type'      => 'warning'
                ]);
            }

           

            $data           = $client->data;
          
            $nombres        = '';
            $direccion      = '';
            $ubigeo         = NULL;

            if(strlen($dni_ruc) == 8) // DNI
            {
                $nombres        = $data->nombres;
                $apellidos      = $data->apellido_paterno . ' ' . $data->apellido_materno;
                $direccion      = $data->direccion;
                $numero         = $data->numero;
            }
            else
            {
                $nombres        = $data->nombre_o_razon_social;
                $direccion      = $data->direccion;
            }

            echo json_encode([
                'status'    => true,
                'nombres'   => $nombres,
                'apellidos' => $apellidos,
                'numero'    => $numero,
            ]);
            return;
        }   

        echo json_encode([
            'status'    => false,
            'msg'       => 'Ingrese un número de documento válido',
            'type'      => 'warning'
        ]);

    }
}  
