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
}
