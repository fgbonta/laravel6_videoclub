<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;


class UsuarioController extends Controller
{
    public function store(Request $request)
    {
    	$input = $request->all();
    	$input['password']=Hash::make($request->password);

    	User::create($input);

    	return response()->json([
    		'succes'=>true,
    		'message'=>'Usuario creado correctamente.'
    	],201);
    }

    public function login(Request $request)
    {
    	$usuario = User::whereEmail($request->email)->first();

    	if($usuario && Hash::check($request->password,$usuario->password))
    	{
    		$usuario->api_token = Str::random(100);
    		$usuario->save();

    		return response()->json([
	    		'succes'=>true,
	    		'token'=>$usuario->api_token,
	    		'message'=>'Bienvenido al sistema.'
	    	],200);
    	}
    	else
    	{
    		return response()->json([
	            'success'=>false,
	            'message'=>"Usuario y/o password incorrectos."
	        ],401);
    	}
    }

    public function logout()
    {
    	$usuario = auth()->user();
    	$usuario->api_token = null;
    	$usuario->save();

    	return response()->json([
	        'success'=>true,
	        'message'=>"Salida del sistema."
	    ],200);
    }
}
