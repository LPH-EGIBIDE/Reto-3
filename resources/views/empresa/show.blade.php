@extends('layouts.app')

@section('scripts')
    @vite('resources/js/editElement.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container">
        @include('alerts')
        <div class="row d-flex justify-content-center">
            <div class="card col-12 col-lg-8 p-0">
            <div class="card-header d-flex align-items-center justify-content-between px-4">
                <span class="text-primary fw-bold fs-3">Vista de empresa</span>
                @can('is_coordinador')
                    <div class="d-flex gap-3">
                        <button type="button" id="editButton" class="btn btn-primary p-2 px-3">
                            <span class="d-none d-md-block">Editar</span>
                            <i class="fa-solid fa-pencil d-block d-md-none"></i>
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body d-flex flex-row justify-content-center">
                <div class="col-12 col-md-8">
                    <form id="editForm" action="{{route('empresa.update', ['id'=> $empresa->id])}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" value="{{$empresa->nombre}}" disabled class="form-control" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" value="{{$empresa->direccion}}" disabled class="form-control" id="direccion">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" name="telefono" value="{{$empresa->telefono}}" disabled class="form-control" id="telefono">
                        </div>
                        <div class="mb-3">
                            <label for="cif" class="form-label">CIF</label>
                            <input type="text" name="cif"  value="{{$empresa->cif}}" disabled class="form-control" id="cif">
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">Area</label>
                            <input type="text" name="area"  value="{{$empresa->area}}" disabled class="form-control" id="area">
                        </div>
                        @can('is_coordinador')
                            <div class="d-flex justify-content-end col-12">
                                <button type="submit" disabled class="btn btn-success p-2 px-3">Confirmar</button>
                            </div>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
