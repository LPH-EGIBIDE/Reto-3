
@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header d-flex align-items-center gap-2">
            @if($persona->profile_pic_id != null)
                <img src="{{route('attachment.show.custom', [$persona->profile_pic_id, 100,100])}}" class="rounded-circle" alt="Imagen usuario" >
            @else
                <img src="{{Vite::asset('resources/images/profile.jpg')}}" class="rounded-circle" alt="Imagen usuario" style="height: 100px">
            @endif
            <span class="card-title text-primary m-0 fs-2 fw-bold">Ficha del alumno</span>
        </div>
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-lg-4">
                        <table class="table">
                            <thead class="text-primary">
                            <tr>
                                <th class="border-dark">Datos del alumno</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <ul class="list-group list-group-flush text-break">
                                        <li class="list-group-item">DNI: {{$persona->dni}}</li>
                                        <li class="list-group-item">Nombre: {{$persona->nombre}} {{$persona->apellido}}</li>
                                        <li class="list-group-item">Email: {{$persona->user->email}}</li>
                                        <li class="list-group-item">Grado: {{$persona->informacion->alumnoHistorico->last()->grado->nombre}}</li>
                                        <li class="list-group-item">Curso: {{$persona->informacion->alumnoHistorico->last()->curso->nombre}}</li>
                                        @if(empty($persona->informacion->alumnoHistorico->last()->facilitadorEmpresa))
                                            <li class="list-group-item">Dual: No</li>
                                        @else
                                            <li class="list-group-item">Empresa: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->nombre}}</li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <table class="table table-responsive">
                            <thead class="text-primary">
                            <tr>
                                <th class="border-dark">Datos de la empresa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    @if(empty($persona->informacion->alumnoHistorico->last()->facilitadorEmpresa))
                                        <span>Aún no tienes una empresa asignada</span>
                                    @else
                                        <ul class="list-group list-group-flush text-break">
                                            <li class="list-group-item">Nombre: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->nombre}}</li>
                                            <li class="list-group-item">Dirección: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->direccion}}</li>
                                            <li class="list-group-item">Teléfono: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->telefono}}</li>
                                            <li class="list-group-item">Área: {{$persona->informacion->alumnoHistorico->last()->facilitadorEmpresa->empresa->area}}</li>
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <table class="table table-responsive">
                            <thead class="text-primary">
                            <tr>
                                <th class="border-dark">Datos del facilitador del centro</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    @if(empty($persona->informacion->alumnoHistorico->last()->facilitadorCentro))
                                        <span>Aún no tienes un facilitador asignado</span>
                                    @else
                                        <ul class="list-group list-group-flush text-break">
                                            <li class="list-group-item">Nombre: {{$persona->informacion->alumnoHistorico->last()->facilitadorCentro->persona->nombre}} {{$persona->informacion->alumnoHistorico->last()->facilitadorCentro->persona->apellido}}</li>
                                            <li class="list-group-item">Correo: {{$persona->informacion->alumnoHistorico->last()->facilitadorCentro->persona->user->email}}</li>
                                            <li class="list-group-item">Teléfono: {{$persona->informacion->alumnoHistorico->last()->facilitadorCentro->persona->telefono}}</li>
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


