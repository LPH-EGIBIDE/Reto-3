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
                    <span class="text-primary fw-bold fs-3">Nuevo grado</span>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <form class="form" id="editForm" action="{{route('grado.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input name="nombre" type="text"   class="form-control" id="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="active"  class="form-label">Coordinador</label>
                                <select  name="coordinador" class="form-select">
                                    <option value="">Sin coordinador</option>
                                    @foreach($facilitadores as $facilitador)
                                            <option value="{{$facilitador->persona_id}}">{{$facilitador->persona->nombre}} {{$facilitador->persona->apellido}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="active"  class="form-label">Familia</label>
                                <select name="familia" class="form-select">
                                    <option value="">Sin familia</option>
                                    @foreach($familias as $familia)
                                            <option value="{{$familia->id}}">{{$familia->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @can('is_coordinador')
                                <div class="d-flex justify-content-end col-12">
                                    <button type="submit" class="btn btn-success p-2 px-3">Confirmar</button>
                                </div>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
