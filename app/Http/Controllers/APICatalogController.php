<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Movie;

class APICatalogController extends Controller
{
    //GET listar todas
    public function index()
    { 

        $movies = Movie::all();            

        return  response()->json($movies,200);       

    } 
   
    //GET listar una pelicula
    public function show($id)
    {

        $movie = Movie::find($id);

        if($movie)
        {
            return response()->json($movie,200);
        }

        return response()->json([
            'success'=>false,
            'message'=>'Película inexistente.'
        ],409);

    }

    //PUT alquilar una pelicula
    public function alquilar(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->first()
            ],409);
        }
        else
        {
            $movie = Movie::find($request->id);

            if($movie)
            {
                if(!$movie->rented)
                {
                   $movie->rented = 1;
                   $movie->save();

                   return response()->json([
                       'success'=>true,
                       'message'=>'Película alquilada.'
                   ],200); 
                }

                return response()->json([
                    'success'=>false,
                    'message'=>'Película no disponible.'
                ],409);
            }

            return response()->json([
                'success'=>false,
                'message'=>'Película inexistente.'
            ],409);            
            
        }      

    }

    //PUT devolver una pelicula
    public function devolver(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->first()
            ],409);
        }
        else
        {
            $movie = Movie::find($request->id);

            if($movie)
            {

                if($movie->rented)
                {
                    $movie->rented = 0;
                    $movie->save();

                    return response()->json([
                        'success'=>true,
                        'message'=>'Película devuelta.'
                    ],200); 
                }
                    
                return response()->json([
                    'success'=>false,
                     'message'=>'Película disponible.'
                ],409);

            }

            return response()->json([
                'success'=>false,
                'message'=>'Película inexistente.'
            ],409);   
            
        }
    }

    //DELETE elimina una pelicula
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->first()
            ],409); 
        }

        $movie = Movie::find($request->id);

        if($movie)
        {
            $movie->delete();

            return response()->json([
                'success'=>true,
                'message'=>'Película eliminada.'
            ],200);
        }

        return response()->json([
            'success'=>false,
            'message'=>'Película inexistente.'
        ],409);
        
    }        

}
