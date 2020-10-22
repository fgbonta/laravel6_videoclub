@extends('layouts.master')

@section('content')

	<div id="titulo">
		<h1>Películas</h1>
	</div>

	<div id="boton-agregar">
		<a href="{{ action('CatalogController@getCreate') }}"><img src="./assets/img/add.png" width="28"></a>
	</div>

	<div id="clearboth"></div>	

	@if( session('mensaje') )

		<div class="alert alert-success">
			{{ session('mensaje') }}
		</div>

	@endif
	
	<div class="row mt-3">

		@foreach($movies as $movie)

		<div style="width: 350px;height:350px;" class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
			
			<div style='height: 80%;background-image: url("/assets/img/{{ $movie->poster }}");
	background-size: cover;
	background-position: center center;'>
				
			</div>

			<div style="height: 20%;">
				<a href="{{ url('catalog/show/'.$movie->id) }}">
					<h4 style="min-height:45px;margin:5px 0 10px 0">
						{{ (strlen($movie->title)>30)? substr($movie->title,0,30).'...' : $movie->title
							    }}						
					</h4>
				</a>
			</div>				
			
		</div>

		@endforeach

	</div>

	{{ $movies->links() }}	

@endsection