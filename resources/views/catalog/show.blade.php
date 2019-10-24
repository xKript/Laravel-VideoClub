@extends('layouts.master')
@section('content')
    <div class="row">
    	<div class="col-sm-4">
     	    <img src="{{$movie->poster}}" style="width: 20vw;" />
    	</div>
	    <div class="col-sm-8">
	    	<h1>{{$movie->title}}</h1>
	    	<div>
	       		<div><strong>Año:</strong> {{$movie->year}}</div>
	       		<div><strong>Director:</strong> {{$movie->director}}</div>
	       		<div>
	       			<strong>Estado:</strong>
	       		 	@if($movie->rented)
	       		 	    Pelicula actualmete alquilada
	       		 	@else
	       		 	    Pelicula disponible
	       		 	@endif
	       		</div><br>
	       </div>
	       <h2>Sinopsis:</h2> <p>{{$movie->synopsis}}</p>
	       <p>
	       		<a class="btn btn-warning" href="{{ url('/catalog/edit/' . $movie->id ) }}"><span class="fa fa-pencil-alt"></span>Editar</a>
	       		@if($movie->rented)
	       			<a class="btn btn-danger" href="">Devolver</a>	           
	       		@else
	       			<a class="btn btn-primary" href="">Alquilar película</a>
	       		@endif     
	       		<a class="btn btn-light" href="{{ url('/catalog/') }}">Volver al sitio</a>
	       		
	       </p>
	    </div> 
	</div>
@stop