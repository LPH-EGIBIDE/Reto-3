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
            <div class="card col-12 col-lg-6 p-0">
                <div class="card-header d-flex align-items-center justify-content-between px-4">
                    <span class="text-primary fw-bold fs-3">Vista de curso</span>
                    @can('is_coordinador')
                        <div class="d-flex gap-3">
                            <button type="button" id="editButton" class="btn btn-primary p-2 px-3">
                                <span class="d-none d-md-block">Editar</span>
                                <i class="fa-solid fa-pencil d-block d-md-none"></i>
                            </button>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <form id="editForm" action="{{route('curso.update',['id'=> $curso->id])}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input disabled name="nombre" type="text" value="{{$curso->nombre}}"  class="form-control" id="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="fecha-inicio" class="form-label">Fecha de inicio</label>
                                <input disabled name="fecha_inicio" type="date" value="{{$curso->fecha_inicio}}"  class="form-control" id="fecha-inicio">
                            </div>
                            <div class="mb-3">
                                <label for="fecha-fin" class="form-label">Fecha de fin</label>
                                <input disabled name="fecha_fin" type="date" value="{{$curso->fecha_fin}}"  class="form-control" id="fecha-fin">
                            </div>
                            <div class="mb-4">
                                <label for="active"  class="form-label">Activo</label>
                                <select disabled name="active" class="form-select">
                                    <option value="1" @if($curso->active) selected  @endif >Si</option>
                                    <option value="0" @if(!$curso->active) selected @endif>No</option>
                                </select>
                            </div>
                            @can('is_coordinador')
                                <div class="d-flex justify-content-end col-12">
                                    <button disabled type="submit" class="btn btn-success p-2 px-3">Confirmar</button>
                                </div>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
