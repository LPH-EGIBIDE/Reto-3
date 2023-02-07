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
        <div class="row align-items-center justify-content-center">
            <div class="card col-12 col-lg-8 p-0">
                <div class="card-header d-flex align-items-center justify-content-between px-4">
                    <span class="text-primary fw-bold fs-4">Vista de facilitador de empresa</span>
                    @can('is_coordinador')
                        <div class="d-flex gap-3">
                            <button type="button" id="editButton" class="btn btn-primary p-2 px-3">
                                <span class="d-none d-md-block">Editar</span>
                                <i class="fa-solid fa-pencil d-block d-md-none"></i>
                            </button>
                        </div>
                    @endcan
                </div>
                <form action="{{route('facilitador-empresa.update', $facilitadorEmpresa->persona_id)}}" id="editForm" method="post" enctype="multipart/form-data">
                    <div class="card-body d-flex flex-row justify-content-around gap-2">
                    <div class="col-4 d-flex flex-column align-items-center justify-content-be m-0 me-4 p-3 gap-3">
                        @if($facilitadorEmpresa->persona->profile_pic_id != null)
                            <img class="img-fluid rounded-circle" id="imgProfile" src="{{route('attachment.show.custom',[$facilitadorEmpresa->persona->profile_pic_id, 512,512])}}" alt="Foto Default">
                        @else
                            <img class="img-fluid rounded-circle" id="imgProfile" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto Default">
                        @endif
                        <input type="button" disabled class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
                    </div>
                    <div class="col-md-7 col-6">

                            @method('PUT')
                            @csrf
                            <input type="file" name="profile_image" id="profpic" class="d-none">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input name="nombre" disabled type="text" value="{{$facilitadorEmpresa->persona->nombre}}" class="form-control" id="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellidos</label>
                                <input name="apellido" disabled type="text" value="{{$facilitadorEmpresa->persona->apellido}}" class="form-control" id="apellido">
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input name="dni" disabled type="text" value="{{$facilitadorEmpresa->persona->dni}}" class="form-control" id="dni">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input name="telefono" disabled type="text" value="{{$facilitadorEmpresa->persona->telefono}}" class="form-control" id="telefono">
                            </div>
                            <div class="mb-4">
                                <label for="empresa" class="form-label">Empresa</label>
                                <select disabled name="id_empresa" class="form-select" aria-label="empresa">
                                    <option value="">Sin empresa</option>
                                    @foreach($empresas as $empresa)
                                        @if($facilitadorEmpresa->empresa_id == $empresa->id)
                                            <option value="{{$empresa->id}}" selected>{{$empresa->nombre}}</option>
                                        @else
                                            <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end col-12">
                                <button type="submit" disabled class="btn btn-success p-2 px-3">Confirmar</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
