@extends('layouts.app')

@section('content')

    @can('alumno')
            @include('alumno.dashboard')
    @endcan

    @can('facilitador_empresa')
            @include('facilitador_empresa.dashboard')
    @endcan

    @can('facilitador_centro')
            @can('is_coordinador')
                @include('facilitador_centro.coordinador.dashboard')
            @else
                @include('facilitador_centro.dashboard')
            @endcan
    @endcan

@endsection
