@extends('layouts.app')

@section('scripts')
    @vite('resources/js/editPersona.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container ">
        @include('alerts')
        <div class="row d-flex flex-row justify-content-around gap-2">
            <div class="card col-12 col-lg-8 p-0 mb-4">
                <div class="card-header d-flex align-items-center justify-content-between px-4">
                    <span class="text-primary fw-bold fs-3">Editar alumno histórico</span>
                    <div class="d-flex gap-3">
                        <button type="button" id="editButton" class="btn btn-primary p-2 px-3">
                            <span class="d-none d-md-block">Editar</span>
                            <i class="fa-solid fa-pencil d-block d-md-none"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body d-flex flex-row justify-content-around gap-2">
                    <form action="{{route('alumnohistorico.update',$alumnoHistorico->id)}}" id="editForm" method="post" enctype="multipart/form-data">
                        <div class="row">
                            @method('PUT')
                            @csrf
                            <div class="col">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="facilitador_centro" class="form-label">Facilitador centro</label>
                                        <select name="facilitador_centro" class="form-select" aria-label="facilitador_centro">
                                            @foreach($listaFacilitadoresCentro as $facilitadorCentro)
                                                <option value="{{$facilitadorCentro->persona_id}}">{{$facilitadorCentro->persona->nombre}} {{$facilitadorCentro->persona->apellido}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="facilitador_empresa" class="form-label">Facilitador empresa</label>
                                        <select name="facilitador_empresa" class="form-select" aria-label="facilitador_empresa">
                                            @foreach($listaFacilitadoresEmpresa as $facilitadorEmpresa)
                                                <option value="{{$facilitadorEmpresa->persona_id}}">{{$facilitadorEmpresa->persona->nombre}} {{$facilitadorEmpresa->persona->apellido}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select name="estado" class="form-select" aria-label="estado">
                                            <option selected value="cursando">Cursando</option>
                                            <option value="finalizado">Finalizado</option>
                                            <option value="repetido">Repetido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <button type="submit" class="btn btn-info p-2 px-3">Editar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

