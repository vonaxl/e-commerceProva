<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AppController extends Controller
{
    public function init(){
        $user =Auth::user();

        return response() -> json(["user" => $user] ,200);
    }


    public function login(Request $request){
        //controllo che esista nel database la mail che si sta loggando
        if(Auth::attempt(["email" => $request -> email , "password" => $request -> password], true)){
            return response()-> json(Auth::user(),200);
        }else{
            //altrimenti restituisco errore
            return response()->json(["error" => "Impossibile effettuare il login"],401);
        }
    }


    public function register(Request $request){

        $user = User::where("email", $request -> email)-> first();

        if(isset($user->id)){
            return response()->json(["error" => "Email già presente"],401);
        }

        //creo un nuovo utente e imposto che i valori immessi nel form di registrazione prendano il valore dei campi nel mio db
        $user = new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = bcrypt($request -> password);
        $user->save();

        Auth::login($user);
        return response() -> json($user,200);
    }


    public function logout(){
        //sfrutto la logout di laravel
        Auth::logout();
    }
}
