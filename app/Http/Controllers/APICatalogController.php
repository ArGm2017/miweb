<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Movie::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Movie;
        $p->title = $request->title;
        $p->year = $request->year;
        $p->director = $request->director;
        $p->poster = $request->poster;
        $p->synopsis = $request->synopsis;
        $p->save();
        return response()->json([
            'msg' => 'La pelicula se ha guardado!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pelicula)
    {
        $pelicula = Movie::findOrFail($pelicula);
        return response()->json(['pelicula' => $pelicula]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pelicula)
    {
        $pelicula = Movie::findOrFail($pelicula);
        $pelicula->title = $request->title;
        $pelicula->year = $request->year;
        $pelicula->director = $request->director;
        $pelicula->poster = $request->poster;
        $pelicula->synopsis = $request->synopsis;
        $pelicula->save();
        return response()->json(['error' => false,
            'msg' => 'La película se ha actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $m = Movie::findOrFail($id);
        $m->delete();
        return response()->json(['error' => false,
            'msg' => 'La película se ha eliminado']);
    }

    public function putRent($id)
    {
        $m = Movie::findOrFail($id);
        $m->rented = true;
        $m->save();
        return response()->json(['error' => false,
            'msg' => 'La película se ha marcado como alquilada']);
    }

    public function putReturn($id)
    {
        $m = Movie::findOrFail($id);
        $m->rented = false;
        $m->save();
        return response()->json(['error' => false,
            'msg' => 'La película ha sido devuelta']);
    }
}
