@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header d-flex align-items-center justify-content-between px-4">
            <span class="text-primary fw-bold fs-3">Vista de curso</span>
            <div class="d-flex gap-3">
                <button type="button" class="btn btn-primary p-2 px-3">
                    <span class="d-none d-md-block">Editar</span>
                    <i class="fa-solid fa-pencil d-block d-md-none"></i>
                </button>
                <button type="button" class="btn btn-danger p-2 px-3">
                    <span class="d-none d-md-block">Borrar</span>
                    <i class="fa-solid fa-trash d-block d-md-none"></i>
                </button>
            </div>
        </div>
        <div class="card-body d-flex flex-row justify-content-center">
            <div class="col-12 col-md-8">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" value="{{$curso->nombre}}" disabled class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="fecha-inicio" class="form-label">Fecha de inicio</label>
                        <input type="date" value="{{$curso->fecha_inicio}}" disabled class="form-control" id="fecha-inicio">
                    </div>
                    <div class="mb-3">
                        <label for="fecha-fin" class="form-label">Fecha de fin</label>
                        <input type="date" value="{{$curso->fecha_fin}}" disabled class="form-control" id="fecha-fin">
                    </div>
                    <div class="mb-4">
                        <label for="active"  class="form-label">Activo</label>
                        <select disabled class="form-select">
                            <option @if($curso->active) selected  @endif >Si</option>
                            <option @if(!$curso->active) selected @endif>No</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end col-12">
                        <button type="submit" disabled class="btn btn-success p-2 px-3">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
