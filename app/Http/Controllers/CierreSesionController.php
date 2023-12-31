<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

date_default_timezone_set('America/La_Paz');

class CierreSesionController extends Controller
{
    public function logout()
    {
        $request = Request::capture();
        //Bitacora
        $id = Auth::id();
        $user = User::find($id);
        $action = "Cerró sesion";
        $Bitacora = Bitacora::create();
        $Bitacora->tipou = $user->tipo;
        $Bitacora->name = $user->name;
        $Bitacora->actividad = $action;
        $Bitacora->fechaHora = date('Y-m-d H:i:s');
        $Bitacora->ip = $request->ip();
        $Bitacora->save();
        //----------
        Session::flush();
        Auth::logout();
        return redirect()->to('/login');
    }
}
