@extends('layouts.master')
@section('content')
    <div class="row" style="margin-top:40px">
       <div class="offset-md-3 col-md-6">
          <div class="card">
             <div class="card-header text-center">
                Modificar película
             </div>
             <div class="card-body" style="padding:30px">
                <form method="POST" action="{{route('catalog.update',$id)}}">
    				@method('PUT')
    				@csrf
	                <div class="form-group">
	                   <label for="title">Título</label>
	                   <input value="{{$movie->title}}" type="text" name="title" id="title" class="form-control">
	                </div>

	                <div class="form-group">
	                   <label for="year">Año</label>
	                   <input value="{{$movie->year}}" type="text" name="year" id="year" class="form-control">
	                </div>

	                <div class="form-group">
	                   <label for="director">Director</label>
	                   <input value="{{$movie->director}}" type="text" name="director" id="director" class="form-control">
	                </div>

	                <div class="form-group">
	                   <label for="poster">Poster</label>
	                   <input value="{{$movie->poster}}" type="text" name="poster" id="poster" class="form-control">
	                </div>

	                <div class="form-group">
	                   <label for="synopsis">Resumen</label>
	                   <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{$movie->synopsis}}</textarea>
	                </div>

	                <div class="form-check">
					  <input class="form-check-input" type="checkbox" {{ $movie->rented==1? "checked":"" }} id="rented">
					  <label class="form-check-label" for="rented">
					    Rentada
					  </label>
					</div>

	                <!-- <div class="form-group">
	                   <label for="synopsis">Rendada</label>
	                   <textarea value="{{$movie->rented}}" name="rented" id="rented" class="form-control" rows="3"></textarea>
	                </div> -->

	                <div class="form-group text-center">
	                   <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
	                       Modificar película
	                   </button>
	                </div>
                </form>

             </div>
          </div>
       </div>
    </div>
@stop