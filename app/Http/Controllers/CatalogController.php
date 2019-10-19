<?php

namespace App\Http\Controllers;
//include 'array_peliculas.php';

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    
    function getIndex()
    {
    	return view('catalog.index',array('arrayPeliculas' => $this->arrayPeliculas));
    }

    function getShow($id)
    {
    	$movie = $this->arrayPeliculas[$id];
        return view('catalog.show' ,array('id' => $id, 'movie' => $movie));
    }

    function getCreate()
    {
    	return view('catalog.create');
    }

    function getEdit($id)
    {
    	return view('catalog.edit' ,array('id' => $id));
    }
}
