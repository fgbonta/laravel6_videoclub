@extends('layouts.master')

@section('content')
	
	<h2>Modificar película</h2>
	<form action="/catalog/edit" method="post" enctype="multipart/form-data" class="mb-2">

		@csrf
        @method('put')

	  <div class="form-group">
	    <label for="titulo">Título:</label>
	    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo',$movie->title) }}">	    
	  </div>

	  <div class="form-group">
	    <label for="anio">Año:</label>
	    <input type="number" min="0" class="form-control" id="anio" name="anio" value="{{ old('anio',$movie->year) }}">	    
	  </div>

	  <div class="form-group">
	    <label for="director">Director:</label>
	    <input type="text" class="form-control" id="director" name="director" value="{{ old('director',$movie->director) }}">	    
	  </div>

	  <div class="form-group">
	    <label for="poster">Poster actual:</label><br>
	    <img src="/assets/img/{{ $movie->poster }}" height="300px" >
	    <input type="file" class="form-control" id="poster" name="poster">	    
	  </div>

	  <div class="form-group">
	    <label for="resumen">Resúmen:</label>
	    <textarea class="form-control" id="resumen" name="resumen">{{ old('resumen',$movie->synopsis) }}</textarea>	    
	  </div>

	  <input type="hidden" name="id" name="id" value="{{ $movie->id }}">
	 <input type="hidden" name="imagenActual" name="imagenActual" value="{{ $movie->poster }}">	  
	  
	  <button type="submit" class="btn btn-primary">Modificar</button>

	  <a href="{{ action('CatalogController@getShow',[$movie->id]) }}" class="btn btn-light">Volver..</a>
	  
	</form>

	@if( $errors->any() )
		<div class="alert alert-danger">
			<ul>
				@foreach( $errors->all() as $error )
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

@endsection