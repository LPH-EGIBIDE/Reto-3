@extends('layouts.app')

@section('scripts')
    @vite(['resources/js/editElement.ts', 'resources/js/editPersona.ts'])
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
                <span class="text-primary fw-bold fs-3">Vista del alumno</span>
                @can('is_coordinador')
                    <div class="d-flex gap-3">
                        <button type="button" id="editButton" class="btn btn-primary p-2 px-3">
                            <span class="d-none d-md-block">Editar</span>
                            <i class="fa-solid fa-pencil d-block d-md-none"></i>
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body d-flex flex-row justify-content-around gap-2">
                <form action="{{route('alumno.update',$alumno->persona_id)}}" id="editForm" method="post" enctype="multipart/form-data">
                <div class="row">
                    @method('PUT') @csrf
                 <div class="col-4 d-flex flex-column align-items-center justify-content-be m-0 me-4 p-3 gap-3">
                     @if($alumno->persona->profile_pic_id != null)
                    <img class="img-fluid rounded-circle" id="imgProfile" src="{{route('attachment.show.custom',[$alumno->persona->profile_pic_id, 512,512])}}" alt="Foto Default">
                    @else
                    <img class="img-fluid rounded-circle" id="imgProfile" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto Default">
                    @endif
                    <input type="file" name="profile_image" id="profpic" class="d-none">
                    @can('is_coordinador')
                        <input type="button" disabled class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
                    @endcan
                </div>
                 <div class="col-md-7 col-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input name="nombre" disabled type="text" value="{{$alumno->persona->nombre}}" class="form-control" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellidos</label>
                            <input name="apellido" disabled type="text" value="{{$alumno->persona->apellido}}" class="form-control" id="apellido">
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input name="dni" disabled type="text" value="{{$alumno->persona->dni}}" class="form-control" id="dni">
                        </div>
                        <div class="mb-4">
                            <label for="telefono" class="form-label">Tel??fono</label>
                            <input name="telefono" disabled type="text" value="{{$alumno->persona->telefono}}" class="form-control" id="telefono">
                        </div> @can('is_coordinador') <div class="d-flex justify-content-end col-12">
                            <button type="submit" disabled class="btn btn-success p-2 px-3">Confirmar</button>
                        </div> @endcan
                </div>
                </div>
                </form>
            </div>
        </div>
    </div> @can('is_coordinador') @include('alumno_historicos.index') @endcan </div>
@endsection

