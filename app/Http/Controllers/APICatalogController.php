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

    private function subirImagen(Request $request)
    {

        $imagen = 'noDisponible.jpg';

        if($request->has('imagenActual'))
        {
            $imagen = $request->input('imagenActual');
        }

        if($request->file('poster'))
        {
            $imagen = time().'.'.$request->file('poster')->clientExtension();

            $request->file('poster')->move(public_path('assets/img'),$imagen);

        }

        return $imagen;

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required|min:1|max:150',
            'year'=>'required|integer|min:1900',
            'director'=>'required|min:1|max:150',
            'synopsis'=>'required|min:1|max:1000',
            'poster'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:1024',
            'rented'=>'required|integer|min:0|max:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->first()
            ],409); 
        }

        $input = $request->all();

        $input['poster'] = $this->subirImagen($request);        

        Movie::create($input);

        return response()->json([
            'success'=>true,
            'message'=>'Película agregada.'
        ],201);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required|min:1|max:150',
            'year'=>'required|integer|min:1900',
            'director'=>'required|min:1|max:150',
            'synopsis'=>'required|min:1|max:1000',
            'poster'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:1024',
            'rented'=>'required|integer|min:0|max:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=>false,
                'message'=>$validator->messages()->first()
            ],409); 
        }

        $input = $request->all();

        $input['poster'] = $this->subirImagen($request);        

        $movie = Movie::find($id);

        if($movie)
        {
            $movie->update($input);

            return response()->json([
                'success'=>true,
                'message'=>'Película actualizada.'
            ],200);
        }

        return response()->json([
            'success'=>false,
            'message'=>'Película inexistente.'
        ],409);

    }        

}
