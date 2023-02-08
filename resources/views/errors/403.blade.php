@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card col-12 col-lg-8 p-0">
            <div class="card-header d-flex align-items-center justify-content-between px-4">
                <span class="text-primary fw-bold fs-5">Error</span>
            </div>
            <div class="card-body d-flex flex-row justify-content-around gap-2">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <img style="width: 50%;" src="{{Vite::asset('resources/images/errors/403.png')}}">
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <h3>Acceso denegado</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
