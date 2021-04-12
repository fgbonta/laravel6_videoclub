@extends('layouts.master')

@section('content')
	<h2>Añadir película</h2>
	<form action="/catalog/create" method="post" enctype="multipart/form-data">

		@csrf

	  <div class="form-group">
	    <label for="titulo">Título:</label>
	    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}">	    
	  </div>

	  <div class="form-group">
	    <label for="anio">Año:</label>
	    <input type="number" min="0" class="form-control" id="anio" name="anio" value="{{ old('anio') }}">	    
	  </div>

	  <div class="form-group">
	    <label for="director">Director:</label>
	    <input type="text" class="form-control" id="director" name="director" value="{{ old('director') }}">	    
	  </div>

	  <div class="form-group">
	    <label for="poster">Poster:</label>
	    <input type="file" class="form-control" id="poster" name="poster">	    
	  </div>

	  <div class="form-group">
	    <label for="resumen">Resúmen:</label>
	    <textarea class="form-control" id="resumen" name="resumen">{{ old('resumen') }}</textarea>	    
	  </div>	  
	  
	  <button type="submit" class="btn btn-primary">Añadir</button>

	   <a href="{{ action('CatalogController@getIndex') }}" class="btn btn-light">Volver al listado</a>
	  
	</form>

	@if( $errors->any() )
		<div class="alert alert-danger mt-2">
			<ul>
				@foreach( $errors->all() as $error )
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	{{-- $errors->get('titulo') --}}
	{{-- $errors->first('titulo') --}}
	{{-- $errors->has('titulo') --}}
	
@endsection