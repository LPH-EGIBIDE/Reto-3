@extends('layouts.app')

@section('scripts')
    @vite('resources/js/filterElement.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')

    @include('facilitador_centro.graphs');

    @include('alumno.smallList');

@endsection