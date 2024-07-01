<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use SessionManager;

class LoginController extends Controller
{
    public function login(Request $request )
    {
       $usuario      = $request->post('usuario');
       $contraseña   = $request->post('contraseña');

       $credenciales = DB::table('usuarios')->select('*')
                                           ->where('usuario', '=', $usuario)
                                           ->where('contraseña', '=', $contraseña)
                                           ->first();
        
        if($credenciales === null)
       {
           return redirect()->back()->with(['success' => 'Registro no encontrado']);
       }
       else
       {
        $request->session()->put(
            [
                'usuario'      =>  $credenciales->usuario,
                'contraseña'   =>  $credenciales->contraseña,
                'idusuario'    =>  $credenciales->idusuario,
                'nombre'       =>  $credenciales->nombre,
                
            ]);

            return redirect('paneladmin');
       }
    }  
    
    public function salir(Request $request)
    {
        
        $request->session()->forget('usuario');
        return redirect('/');
    }

    public function register(Request $request)
    {
        return view('registrar.index');
    }

    public function save_registre(Request $request)
    {
        
        if(!$request->ajax())
        {
            echo json_encode([
                'status' => false
            ]);
            return;
        }
        $documento = $request->post('documento');
        $nombre    = $request->post('nombre');
       
        $correo    = $request->post('correo');
        $telefono  = $request->post('telefono');
        $contraseña= $request->post('contra');

        DB::table('clientes_web')->insert([

            'documento' => $documento,
            'nombre'    => $nombre,
            'correo'    => $correo,
            'telefono'  => $telefono,
            'contraseña'=> $contraseña,
        ]);

        echo json_encode([
           'status' => true
        ]);

        
      
    }

    public function login_web(Request $request)
    {
        if(!$request->ajax())
        {
            
            echo json_encode([
            
                'status' => false,

            ]);
        
        }

    $documento = $request->post('documento');
    $contra    = $request->post('contra');
    $credenciales = DB::table('clientes_web')->select('*')->where('documento', '=', $documento)->where('contraseña', '=', $contra)->first();

   

    if(empty($credenciales))
    {
        echo json_encode([
            
            'status' => false,

        ]);
        return;

    }

        $request->session()->put(
        [
            'usuario'       => $credenciales->nombre,
            'correo'        => $credenciales->correo,
            'telefono'      => $credenciales->telefono,
            
        ]);

    echo json_encode([

        'status'=> true,
    ]);



    }
                                           
}
