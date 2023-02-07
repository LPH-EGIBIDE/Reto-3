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
        <div class="row align-items-center justify-content-center">
            <div class="card col-12 col-lg-8 p-0 d-flex">
                <div class="card-header text-primary fw-bold fs-3">Crear facilitador del centro</div>
                <div class="card-body d-flex flex-row">
                    <div class="col-3 d-flex flex-column align-items-center justify-content-be m-0 me-4 p-3 gap-3">
                        <img class="img-fluid rounded-circle" id="imgProfile" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto Default">
                        <input type="button" class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
                    </div>
                    <div class="col-8">
                        <form action="{{route('facilitador-centro.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="profile_image" id="profpic" class="d-none">
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
                            <div class="d-flex justify-content-end w-100">
                                <button type="submit" class="btn btn-success p-2 px-3">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
