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
	       
	       <h2>Sinopsis:</h2>
	       <p>{{$movie->synopsis}}</p>

	       <div class="row">

	       		<div style="margin: 10px;">
		       		<a class="btn btn-warning" href="{{ url('/catalog/edit/' . $movie->id ) }}"><span class="fa fa-pencil-alt"></span>  Editar</a>
	       		</div>

	       		<div style="margin: 10px;">
	       			<form action="{{action('CatalogController@deleteMovie', $movie->id)}}" method="POST" style="display:inline"> {{ method_field('DELETE') }} {{ csrf_field() }} <button type="submit" class="btn btn-danger" style="display:inline"> Eliminar película </button> </form>
	       		</div>

	       		@if($movie->rented)
	       			<div style="margin: 10px;">
	       				<form action="{{action('CatalogController@putReturn', $movie->id)}}" method="POST" style="display:inline"> {{ method_field('PUT') }} {{ csrf_field() }} <button type="submit" class="btn btn-info" style="display:inline"> Devolver película </button> </form>	           
	       			</div>
	       		@else
	       			<div style="margin: 10px;">
	       				<form action="{{action('CatalogController@putRent', $movie->id)}}" method="POST" style="display:inline"> {{ method_field('PUT') }} {{ csrf_field() }} <button type="submit" class="btn btn-primary" style="display:inline"> Alquilar película </button> </form>	
	       			</div>
	       		@endif
	       		
	       		<div style="margin: 10px;">
	       			<a class="btn btn-dark" href="{{ url('/catalog/') }}"><span class="" >
	       			Volver al sitio</span></a>
	       		</div>

	       	</div>
	    </div> 
	</div>
@stop