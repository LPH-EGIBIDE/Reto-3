@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container">
        @include('alerts')
        <div class="card mb-3 col-12 col-lg-10">
            <div class="card-header d-flex align-items-center gap-2">
                <img src="https://pub-static.fotor.com/assets/projects/pages/d5bdd0513a0740a8a38752dbc32586d0/fotor-03d1a91a0cec4542927f53c87e0599f6.jpg" class="rounded-circle" alt="Imagen usuario" style="height: 100px">
                <span class="card-title text-primary m-0 fs-2 fw-bold">Ficha del perfil</span>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center gap-2">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="h5 text-primary fw-bold">Información</div>
                            </div>
                            <div class="card-body py-0">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <ul class="list-group list-group-flush text-break">
                                                <li class="list-group-item">Nombre: {{$persona->nombre}}  {{$persona->apellido}}</li>
                                                <li class="list-group-item">DNI: {{$persona->dni}}</li>
                                                <li class="list-group-item">Teléfono: {{$persona->telefono}}</li>
                                                @can('facilitador_centro')

                                                @endcan
                                                @can('alumno')
                                                    <li class="list-group-item">Grado: {{$persona->informacion->alumnoHistorico->last()->grado->nombre}}</li>
                                                    <li class="list-group-item">Año: {{$persona->informacion->alumnoHistorico->last()->curso->nombre}}</li>
                                                @if($persona->informacion->alumnoHistorico->last()->facilitador_empresa != null)
                                                        <li class="list-group-item">Dual: Si</li>
                                                        <li class="list-group-item">Empresa: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->nombre}}</li>
                                                    @else
                                                        <li class="list-group-item">Dual: No</li>
                                                @endif

                                                @endcan
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="h5 text-primary fw-bold">Seguridad</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-center px-5">
                                <div class="form mb-4" id="changePassword">
                                    <p class="text-primary fw-bold">Cambiar contraseña</p>
                                    <input type="text" id="actualPass" placeholder="Contraseña actual" class="form-control mb-3 w-75">
                                    <input type="text" id="newPass" placeholder="Nueva contraseña" class="form-control mb-3 w-75">
                                    <button type="submit" class="btn btn-success fw-bold">Actualizar</button>
                                </div>
                                <div class="d-flex align-items-bottom justify-content-end">
                                    <a href="{{route("2fa.enable.step-1")}}" class="btn btn-primary fw-bold" id="2faButton">Activar 2FA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
