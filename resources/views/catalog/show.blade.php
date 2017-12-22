@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img src="{{ $pelicula->poster }}" style="height:400px"/>

    </div>
    <div class="col-sm-8">

        <h1 style="min-height:45px;margin:5px 0 10px 0">
                {{$pelicula->title }}
            </h1>
            <h4 style="min-height:45px;margin:5px 0 10px 0">
                Año: {{$pelicula->year }}
            </h4>
            <h4 style="min-height:45px;margin:5px 0 10px 0">
                Director: {{$pelicula->director }}
            </h4>
            <h5 style="min-height:45px;margin:5px 0 10px 0">
                <b>Resumen: </b>{{$pelicula->synopsis }}
            </h5>
            <h5 style="min-height:45px;margin:5px 0 10px 0">
                <b>Estado: </b>
            @if ($pelicula['rented'] == 1)
            Película actualmente alquilada!
            @else
            Película Disponible!
            @endif
            </h5>


            @if ($pelicula->rented == 1)

            <form action="{{action('CatalogController@putReturn', $pelicula->id)}}"
                method="POST" style="display:inline">
                {{  method_field('PUT') }}
                {{  csrf_field()  }}
                <button type="submit" class="btn btn-danger" style="display:inline">
                Devolver película </button>
            </form>
            @else

            <form action="{{action('CatalogController@putRent', $pelicula->id)}}"
                method="POST" style="display:inline">
                {{  method_field('PUT') }}
                {{  csrf_field()  }}
                <button type="submit" class="btn btn-primary btn-sm" style="display:inline">
                Alquilar película </button>
            </form>
            @endif
            </h5>


            <a href="{{ action('CatalogController@putEdit', ['id' => $pelicula->id]) }}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil" >
            </i>EDITAR PELÍCULA</a>


            <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}"
                method="POST" style="display:inline">
                {{  method_field('DELETE') }}
                {{  csrf_field()  }}
                <button type="submit" onclick="return confirm('¿Está seguro que desea eliminar esta película?')" class="btn btn-danger" style="display:inline">
                Eliminar Película</button>
            </form>


            <a href="{{ action('CatalogController@getIndex') }}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-menu-left" >
             </i>VOLVER AL LISTADO</a>


    </div>
</div>
@stop
