@extends('layouts.master')

@section('content')

		@if( session('mensaje') )
			<div class="alert alert-success">
				{{ session('mensaje') }}
			</div>
		@endif	
			
		<div class="row mt-3">
			<div class="col-sm-4">
				<img src="/assets/img/{{ $movie->poster }}" width="100%">
			</div>
			<div class="col-sm-8">				
				<h1>Titulo: {{ $movie->title }}</h1>
				Año: {{ $movie->year }}<br>
				Director: {{ $movie->director }}<br>
				
				<p class="mt-4"><span class="font-weight-bold">Resúmen:</span> {{ $movie->synopsis }}</p>
				<p class="mt-4"><span class="font-weight-bold">Estado:</span> {{ ($movie->rented)? 'Película actualmente alquilada' : 'Película disponible' }}</p>
				@if($movie->rented)
					<a href="/catalog/devolverPelicula/{{ $movie->id }}" class="btn btn-danger">Devolver película</a>
				@else
					<a href="/catalog/alquilarPelicula/{{ $movie->id }}" class="btn btn-primary">Alquilar película</a>
				@endif
				<a href="{{ action('CatalogController@getEdit',[$movie->id]) }}" class="btn btn-warning">Editar película</a>

				<a href="{{ action('CatalogController@getIndex') }}" class="btn btn-light">Volver al listado</a>
			</div>
		</div>	
	
@endsection