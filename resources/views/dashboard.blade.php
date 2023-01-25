@extends('layouts.app')

@section('content')

    @can('alumno')
            <h1>Alumno</h1>
    @endcan

    @can('facilitador_empresa')
            <h1>Facilitador empresa</h1>
    @endcan

    @can('facilitador_centro')
            <h1>Admin</h1>
    @endcan

@endsection
