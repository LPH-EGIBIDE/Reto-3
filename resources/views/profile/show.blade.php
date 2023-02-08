@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container d-flex flex-column align-items-center">
        @include('alerts')
        <div class="card mb-3 col-12 col-lg-10">
            <div class="card-header d-flex align-items-center gap-2">
                @if($persona->profile_pic_id != null)
                    <img src="{{route('attachment.show.custom', [$persona->profile_pic_id, 100,100])}}" class="rounded-circle" alt="Imagen usuario" >
                @else
                    <img src="{{Vite::asset('resources/images/profile.jpg')}}" class="rounded-circle" alt="Imagen usuario" style="height: 100px">
                @endif

                <span class="card-title text-primary m-0 fs-2 fw-bold">Ficha del perfil</span>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center gap-2">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between p-3">
                                <div class="h5 text-primary fw-bold m-0">Información</div>
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
                                                <li class="list-group-item">Email: {{$persona->user->email}}</li>
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
                                                @can('facilitador_empresa')
                                                    <li class="list-group-item">Empresa: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->nombre}}</li>
                                                @endcan
                                                @can('is_coordinador')
                                                    <li class="list-group-item">Grado: {{$persona->informacion->alumnoHistorico->last()->grado->nombre}}</li>
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
                            <div class="card-header d-flex align-items-center justify-content-between p-3">
                                <div class="h5 text-primary fw-bold m-0">Seguridad</div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-center px-5">
                                <form action="{{route('profile.update.password')}}" class="form mb-4" id="changePassword" method="post">
                                    @csrf
                                    @method('PUT')
                                    <p class="text-primary fw-bold mb-1">Cambiar contraseña</p>
                                    <input type="password" name="actualPass" id="actualPass" placeholder="Contraseña actual" class="form-control mb-3">
                                    <input type="password" name="newPass" id="newPass" placeholder="Nueva contraseña" class="form-control mb-3">
                                    <input type="password" name="newPass_confirmation" id="newPass_confirmation" placeholder="Repetir nueva contraseña" class="form-control mb-3">
                                    <button type="submit" class="btn btn-primary fw-bold">Actualizar</button>
                                </form>
                                <div class="mb-2">
                                    <p class="text-primary fw-bold mb-1">Verificación en dos pasos</p>
                                    @if(auth()->user()->google2fa_secret != null)
                                        <a href="{{route("2fa.disable")}}" class="btn btn-danger fw-bold" id="2faButton">Desactivar 2FA</a>
                                    @else
                                        <a href="{{route("2fa.enable.step-1")}}" class="btn btn-success fw-bold" id="2faButton">Activar 2FA</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
