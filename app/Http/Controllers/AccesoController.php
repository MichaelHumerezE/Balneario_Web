<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Bitacora;
use App\Models\PageVisit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('America/La_Paz');

class AccesoController extends Controller
{
    public function show()
    {
        if(Auth::check()){
            return redirect('/home');
        }
        //Visitas
        $page = 'Login'; // Reemplaza con el nombre único de tu página
        $pageVisits = PageVisit::firstOrCreate(['page' => $page]);
        $pageVisitsCount = $pageVisits->visits;

        // Incrementa el contador
        $pageVisits->increment('visits');
        //
        return view('auth.login', compact('pageVisitsCount'));
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        if (!Auth::validate($credentials)) {
            return redirect()->to('/login')->withErrors('Email and/or password is incorrect.');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        //Bitacora
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $action = "Inició de sesion";
        $Bitacora = Bitacora::create();
        $Bitacora->tipou = $user->tipo;
        $Bitacora->name = $user->name;
        $Bitacora->actividad = $action;
        $Bitacora->fechaHora = date('Y-m-d H:i:s');
        $Bitacora->ip = $request->ip();
        $Bitacora->save();
        //------------------------------------
        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user)
    {
        return redirect('/home');
    }
}
