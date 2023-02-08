@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container">
        @include('alerts')
        <div class="row d-flex align-items-center justify-content-center">
            <div class="card col-12 col-lg-8 p-0">
                <div class="card-header d-flex justify-content-between px-4">
                    <span class="text-primary fw-bold fs-3">Añadir curso</span>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-7 col-6">
                        <form action="{{route('curso.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="fe_Ini" class="form-label">Fecha inicio</label>
                                <input type="date" name="fecha_inicio"  class="form-control" id="fe_Ini">
                            </div>
                            <div class="mb-4">
                                <label for="fe_Fin" class="form-label">Fecha fin</label>
                                <input type="date" name="fecha_fin"  class="form-control" id="fe_Fin">
                            </div>

                            <div class="d-flex justify-content-end col-12">
                                <button type="submit"  class="btn btn-success p-2 px-3">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
