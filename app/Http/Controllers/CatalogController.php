<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Notification;

class CatalogController extends Controller {
	//

	public function getIndex() {
		$pelicula = Movie::get();
		return view('catalog.index', ['pelicula' => $pelicula]);
	}

	public function getShow($id) {
		$pelicula = Movie::findOrFail($id);
		return view('catalog.show', array('pelicula' => $pelicula));
	}

	public function getEdit($id) {
		$pelicula = Movie::findOrFail($id);
		return view('catalog.edit', array('pelicula' => $pelicula));
	}

	public function getCreate() {
		return view('catalog.create');
	}

	public function postCreate(Request $request) {
		$p = new Movie;
		$p->title = $request->title;
		$p->year = $request->year;
		$p->director = $request->director;
		$p->poster = $request->poster;
		$p->synopsis = $request->synopsis;
		$p->save();
		Notification::success('Se ha creado la película correctamente');
		return redirect('/catalog');
	}

	public function putEdit(Request $request, $id) {
		$pelicula = Movie::findOrFail($id);
		$pelicula->title = $request->title;
		$pelicula->year = $request->year;
		$pelicula->director = $request->director;
		$pelicula->poster = $request->poster;
		$pelicula->synopsis = $request->synopsis;
		$pelicula->save();
		//dd($pelicula->id);
		Notification::success('Se ha modificado la película correctamente');
		return redirect("/catalog/show/{$pelicula->id}");
	}

	public function putRent(Request $request, $id) {
		$pelicula = Movie::findOrFail($id);
		$pelicula->rented = true;
		$pelicula->save();
		Notification::success('Se ha alquilado la película.');
		return redirect("/catalog/show/{$pelicula->id}");
	}

	public function putReturn(Request $request, $id) {
		$pelicula = Movie::findOrFail($id);
		$pelicula->rented = false;
		$pelicula->save();
		Notification::success('Ha devuelto esta película.');
		return redirect("/catalog/show/{$pelicula->id}");
	}

	public function deleteMovie(Request $request, $id) {
		$pelicula = Movie::findOrFail($id);
		$pelicula->delete();
		Notification::error('Se ha eliminado la película');
		return redirect('/catalog');
	}

}
