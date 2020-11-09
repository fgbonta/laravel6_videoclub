<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class APICatalogController extends Controller
{
    
    public function index()
    { 

        $movies = Movie::all();            

        return  response()->json($movies,200);       

    } 
   
    public function show($id)
    {

        $movie = Movie::findOrFail($id);

        return response()->json($movie,200);
    }    

}
