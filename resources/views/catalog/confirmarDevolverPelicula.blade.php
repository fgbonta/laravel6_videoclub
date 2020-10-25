@extends('layouts.master')
@section('content')
	

	<article class="card col-4 mx-auto mt-5 p-0 text-danger border-danger">

        <div class="card-header">
            Se devolverá la película:
        </div>

        <div class="card-body">

            <form action="/catalog/devolverPelicula" method="post">
            
	            @csrf	            
	           	@method('put')

	            <span class="display-4">
	               {{ $movie->title }}
	            </span>
	            
	            <br>
	            <input type="hidden" name="id" value="{{ $movie->id }}">
                <button class="btn btn-primary btn-block mt-2">Confirmar Devolver</button>               

                <a href="{{ action('CatalogController@getShow',[$movie->id]) }}" class="btn btn-light btn-block mt-2">Volver..</a>

            </form>

        </div>

    </article>


@endsection