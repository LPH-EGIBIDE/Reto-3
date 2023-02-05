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
                    <span class="text-primary fw-bold fs-3">Vista de grado</span>
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
                        <form id="editForm" action="{{route('grado.update',['id'=> $grado->id])}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input disabled name="nombre" type="text" value="{{$grado->nombre}}"  class="form-control" id="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="active"  class="form-label">Coordinador</label>
                                <select disabled name="coordinador" class="form-select">
                                    <option value="">Sin coordinador</option>
                                    @foreach($facilitadores as $facilitador)
                                        @if($facilitador->persona_id == $grado->coordinador_id)
                                            <option selected value="{{$facilitador->persona_id}}">{{$facilitador->persona->nombre}} {{$facilitador->persona->apellido}}</option>
                                        @else
                                            <option value="{{$facilitador->persona_id}}">{{$facilitador->persona->nombre}} {{$facilitador->persona->apellido}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="active"  class="form-label">Familia</label>
                                <select disabled name="familia" class="form-select">
                                    <option value="">Sin familia</option>
                                    @foreach($familias as $familia)
                                        @if($familia->id == $grado->familia_id)
                                            <option selected value="{{$familia->id}}">{{$familia->nombre}}</option>
                                        @else
                                            <option value="{{$familia->id}}">{{$familia->nombre}}</option>
                                        @endif
                                    @endforeach
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
