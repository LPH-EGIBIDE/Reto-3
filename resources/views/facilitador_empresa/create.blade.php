@extends('layouts.app')

@section('scripts')
    @vite('resources/js/filterElement.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        @include('alerts')
        <div class="card col-12 col-lg-8 p-0">
            <div class="card-header text-primary fw-bold fs-3">Crear facilitador de empresa</div>
            <div class="card-body d-flex flex-row">
                <div class="col-3 d-flex flex-column align-items-center justify-content-be m-0 me-4 p-3 gap-3">
                    <img class="img-fluid" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto Default">
                    <input type="file" id="profpic" class="d-none">
                    <input type="button" class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
                </div>
                <div class="col-8">
                    <form action="{{route('facilitador-empresa.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input name="nombre" type="text" class="form-control" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellidos</label>
                            <input name="apellido" type="text" class="form-control" id="apellido">
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input name="dni" type="text" class="form-control" id="dni">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input name="telefono" type="text" class="form-control" id="telefono">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Correo</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                        <div class="mb-4">
                            <label for="empresa" class="form-label">Empresa</label>
                            <select name="id_empresa" class="form-select" aria-label="empresa">
                                <option value="">Sin empresa</option>
                                @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end w-100">
                            <button type="submit" class="btn btn-success p-2 px-3">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
