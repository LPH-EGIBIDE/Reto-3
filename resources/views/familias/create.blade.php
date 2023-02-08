@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header d-flex align-items-center justify-content-between px-4">
            <span class="text-primary fw-bold fs-3">Familias</span>

        </div>
        <div class="card-body d-flex flex-row justify-content-around gap-2">
            <div class="col-md-7 col-6">
                <form method="post" action="{{ route('familia.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>

                    <div class="d-flex justify-content-end col-12">
                        <button type="submit" class="btn btn-success p-2 px-3">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

