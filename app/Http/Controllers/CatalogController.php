<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class CatalogController extends Controller
{
    
    public function getIndex(){

        $movies = Movie::paginate(7);

    	return view('catalog.index', ['movies'=>$movies] );
    }

    public function getShow($id){
        
        $movie = Movie::findOrFail($id);       

    	return view('catalog.show', ['movie'=>$movie] );

    }

    public function getCreate(){
    	return view('catalog.create');
    }

    public function getEdit($id){

        $movie = Movie::findOrFail($id);

    	return view('catalog.edit',array('movie'=>$movie));
    }

    public function validar(Request $request)
    {
        $request->validate(
            [
                'titulo'=>'required|min:1|max:150',
                'anio'=>'required|integer|min:1900',
                'director'=>'required|min:1|max:150',
                'resumen'=>'required|min:1|max:1000',
                'poster'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:1024'
            ]);
    }

    public function subirImagen(Request $request)
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

     public function putEdit(Request $request){

        $this->validar($request);

        $movie = Movie::findOrFail($request->input('id'));

        $movie->title = $request->input('titulo');
        $movie->year = $request->input('anio');
        $movie->director = $request->input('director');
        
        $movie->poster = $this->subirImagen($request);        

        $movie->synopsis = $request->input('resumen');

        $movie->save();

        return redirect('/catalog')
            ->with('mensaje','Película: '.$request->input('titulo').' modificada');
        
    }    
   
}
