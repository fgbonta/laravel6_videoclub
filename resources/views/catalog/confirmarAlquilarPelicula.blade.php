@extends('layouts.master')
@section('content')
	

	<article class="card col-4 mx-auto mt-5 p-0 text-danger border-danger">

        <div class="card-header">
            Se alquilará la película:
        </div>

        <div class="card-body">

            <form action="/catalog/alquilarPelicula" method="post">
            
	            @csrf	            
	           	@method('put')

	            <span class="display-4">
	               {{ $movie->title }}
	            </span>
	            
	            <br>
	            <input type="hidden" name="id" value="{{ $movie->id }}">
                <button class="btn btn-primary btn-block mt-2">Confirmar Alquiler</button>               

                <a href="{{ action('CatalogController@getShow',[$movie->id]) }}" class="btn btn-light btn-block mt-2">Volver..</a>

            </form>

        </div>

    </article>

    @if( $errors->has('id') )
		<div class="alert alert-danger mt-2">
			<ul>				
				<li>{{ $errors->first('id') }}</li>				
			</ul>
		</div>
	@endif

@endsection