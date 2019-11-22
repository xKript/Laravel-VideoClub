<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Movie;
use Coderatio\Laranotify\Facades\Notify;

class CatalogController extends Controller
{
    
    function getIndex()
    {
    	$movies = DB::table('movies')->get();
        return view('catalog.index',array('arrayPeliculas' => $movies));
    }

    function getShow($id)
    {
    	$movie = Movie::findOrFail($id);
        return view('catalog.show' ,array('id' => $id, 'movie' => $movie));
    }

    function getCreate()
    {
    	return view('catalog.create');
    }

    function getEdit($id)
    {
    	$movie = Movie::findOrFail($id);
        return view('catalog.edit' ,array('id' => $id, 'movie' => $movie));
    }


    function postCreate(Request $request)
    {
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');
        $poster = $request->input('poster');
        $rented = $request->input('rented');
        if(is_null($rented))
        {
            $rented = false;   
        }
        $synopsis = $request->input('synopsis');

        // Validations here...

        $p = new Movie;
        $p->title = $title;
        $p->year = $year;
        $p->director = $director;
        $p->poster = $poster;
        $p->rented = $rented;
        $p->synopsis = $synopsis;

        if($p->save())
        {
            Notify::info ('Pelicula creada!')->progress(false);
        }
        else
        {
            Notify::error('Error! la pelicula no pudo ser creada...')->progress(false);
        }

        //return redirect()->route('catalog');
        return redirect()->action('CatalogController@getIndex');
    }

    function putUpdate(Request $request, $id)
    {
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');
        $poster = $request->input('poster');
        $rented = $request->input('rented');
        if(is_null($rented))
        {
            $rented = false;   
        }
        $synopsis = $request->input('synopsis');

        //$id = $request->get('id');
        // Validations here...

        $p = Movie::findOrFail($id);
        $p->title = $title;
        $p->year = $year;
        $p->director = $director;
        $p->poster = $poster;
        $p->rented = $rented;
        $p->synopsis = $synopsis;
        if($p->save())
        {
            Notify::info('Cambios guardados!')->progress(false);
        }
        else
        {
            Notify::error('Error! los cambios no se guardaron...')->progress(false);
        }

        return redirect()->action('CatalogController@getShow',['id' => $id]);
    }

    function putRent(Request $request, $id)
    {
        $p = Movie::findOrFail($id);
        $p->rented = true;
        if($p->save())
        {
            Notify::success('Rentada correctamente!')->progress(false);
        }
        else
        {
            Notify::error('Error! la película no pudo rentarse...')->progress(false);
        }
        return redirect()->action('CatalogController@getShow',['id' => $id]);
    }

    function putReturn(Request $request, $id)
    {
        $p = Movie::findOrFail($id);
        $p->rented = false;
        if($p->save())
        {
            Notify::success('Película devuleta!')->progress(false);
        }
        else
        {
            Notify::error('Error! la película no pudo ser devuleta...')->progress(false);
        }

        return redirect()->action('CatalogController@getShow',['id' => $id]);
    }

    function deleteMovie(Request $request, $id)
    {
        $p = Movie::findOrFail($id);
        $mname = $p->title;
        if($p->delete())
        {
            Notify::warning('La película ' . $mname . ' fue eliminada!')->progress(false);
        }
        else
        {
            Notify::error('Error! la película no pudo ser eliminada...')->progress(false);
        }
        return redirect()->action('CatalogController@getIndex');
    }


}
