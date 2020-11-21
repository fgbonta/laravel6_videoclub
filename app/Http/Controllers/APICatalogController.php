<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Movie;

class APICatalogController extends Controller
{
    //GET listar
    public function index()
    { 

        $movies = Movie::all();            

        return  response()->json($movies,200);       

    } 
   
    //GET listar una
    public function show($id)
    {

        $movie = Movie::findOrFail($id);

        return response()->json($movie,200);
    }

    //PUT alquilar
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
            $movie = Movie::findOrFail($request->id);
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

    }

     //PUT devolver
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
            $movie = Movie::findOrFail($request->id);
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
    }        

}
