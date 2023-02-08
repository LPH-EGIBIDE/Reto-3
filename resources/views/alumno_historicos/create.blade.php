@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection
@section('scripts')
    @vite('resources/js/alumnoHistorico.ts')
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center flex-column">
        @include('alerts')
        <div class="card col-12 col-lg-8 p-0">
            <div class="card-header d-flex align-items-center justify-content-between px-4">
                <span class="text-primary fw-bold fs-5">Histórico alumno</span>
            </div>
            <div class="card-body">
                <div class="container ">
                    <form class="form-historico" action="{{route('alumnohistorico.store')}}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="filtro" class="form-label">Alumno</label>
                                <input name="alumno_id" class="form-control" list="alumnoList" id="filtro" placeholder="Buscar" autocomplete="off">
                                <datalist id="alumnoList"></datalist>
                            </div>
                            <div class="col-6">
                                <label for="grado_id" class="form-label">Grado</label>
                                <select name="grado_id" class="form-select" aria-label="grado_id">
                                    @foreach($listaGrados as $grado)
                                        <option value="{{$grado->id}}">{{$grado->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="facilitador_centro" class="form-label">Facilitador centro</label>
                                <select name="facilitador_centro" class="form-select" aria-label="facilitador_centro">
                                    @foreach($listaFacilitadoresCentro as $facilitadorCentro)
                                        <option value="{{$facilitadorCentro->persona_id}}">{{$facilitadorCentro->persona->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="facilitador_empresa" class="form-label">Facilitador empresa</label>
                                <select name="facilitador_empresa" class="form-select" aria-label="facilitador_empresa">
                                    @foreach($listaFacilitadoresEmpresa as $facilitadorEmpresa)
                                        <option value="{{$facilitadorEmpresa->persona_id}}">{{$facilitadorEmpresa->persona->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="estado" class="form-label">Estado</label>
                                <select name="estado" class="form-select" aria-label="estado">
                                    <option selected value="cursando">Cursando</option>
                                    <option value="finalizado">Finalizado</option>
                                    <option value="repetido">Repetido</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-end justify-content-end col-6">
                                <button type="submit" class="btn btn-success p-2 px-3">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
