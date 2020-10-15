@extends('layouts.master')

@section('content')
	<h2>Añadir película</h2>
	<form enctype="multipart/form-data">

		@csrf

	  <div class="form-group">
	    <label for="titulo">Título:</label>
	    <input type="text" class="form-control" id="titulo" name="titulo">	    
	  </div>

	  <div class="form-group">
	    <label for="anio">Año:</label>
	    <input type="number" min="0" class="form-control" id="anio" name="anio">	    
	  </div>

	  <div class="form-group">
	    <label for="director">Director:</label>
	    <input type="text" class="form-control" id="director" name="director">	    
	  </div>

	  <div class="form-group">
	    <label for="poster">Poster:</label>
	    <input type="file" class="form-control" id="poster" name="poster">	    
	  </div>

	  <div class="form-group">
	    <label for="resumen">Resúmen:</label>
	    <textarea class="form-control" id="resumen" name="resumen"></textarea>	    
	  </div>	  
	  
	  <button type="submit" class="btn btn-primary">Añadir</button>
	  
	</form>
	
@endsection