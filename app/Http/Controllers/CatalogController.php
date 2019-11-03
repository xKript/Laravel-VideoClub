<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Movie;
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
        $p->save();

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
        $p->save();

        return redirect()->action('CatalogController@getIndex',['id' => $id]);
    }
}
