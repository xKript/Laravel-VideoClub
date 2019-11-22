<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Movie::all() );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');
        $poster = $request->input('poster');
        $synopsis = $request->input('synopsis');
        $rented = $request->input('rented');
        if(is_null($rented)) {$rented = false;}

        $p = new Movie;
        if($title==null)
        {
            return response()->json( ['error' => true,
                'msg' => 'Error, se requiere el parametro title']);
        }
        $p->title = $title;
        if($year==null)
        {
            return response()->json( ['error' => true,
                'msg' => 'Error, se requiere el parametro year']);
        }
        $p->year = $year;
        if($director==null)
        {
            return response()->json( ['error' => true,
                'msg' => 'Error, se requiere el parametro director']);
        }
        $p->director = $director;
        if($poster==null)
        {
            return response()->json( ['error' => true,
                'msg' => 'Error, se requiere el parametro poster']);
        }
        $p->poster = $poster;
        $p->rented = $rented;
        if($synopsis==null)
        {
            return response()->json( ['error' => true,
                'msg' => 'Error, se requiere el parametro synopsis']);
        }
        $p->synopsis = $synopsis;
        if($p->save())
        {
            $status = 'Pelicula creada';
            $anyError = false;
        }
        else
        {
            $status = 'No fue posible actualizar la pelicula';
            $anyError = true;
        }

        return response()->json( ['error' => $anyError,'msg' => $status ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $m = Movie::findOrFail( $id );
        return response()->json( $m );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        if($title!=null) {$p->title = $title;}
        if($year!=null) {$p->year = $year;}
        if($director!=null) {$p->director = $director;}
        if($poster!=null) {$p->poster = $poster;}
        if($rented!=null) {$p->rented = $rented;}
        if($synopsis!=null) {$p->synopsis = $synopsis;}
        if($p->save())
        {
            $status = 'Pelicula actualizada';
            $anyError = false;
        }
        else
        {
            $status = 'No fue posible actualizar la pelicula';
            $anyError = true;
        }

        return response()->json( ['error' => $anyError,'msg' => $status ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $p = Movie::findOrFail($id);
        }
        catch (NotFoundHttpException $e) {
            $status = 'La pelicula a eliminar no existe';
        }
        catch (Exception $ex) {}

        if($p->delete())
        {
            $status = 'Pelicula eliminada correctamente';
            $anyError = false;
        }
        else
        {
            $status = 'No se pudo eliminar la pelicula';   
            $anyError = true;
        }
        return response()->json( ['error' => $anyError,'msg' => $status ] );
    }

    public function putRent($id)
    {
        $m = Movie::findOrFail( $id );
        $m->rented = true;
        $m->save();
        return response()->json( ['error' => false,
            'msg' => 'La película se ha marcado como alquilada' ] );
    }

    public function putReturn($id)
    {
        $m = Movie::findOrFail( $id );
        $m->rented = false;
        $m->save();
        return response()->json( ['error' => false,
            'msg' => 'La película se ha marcado como disponible' ] );
    }
}
