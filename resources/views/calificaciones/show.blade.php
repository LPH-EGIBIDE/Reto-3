@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center flex-row">
        <div class="card col-12 col-lg-10 p-0">
            <div class="card-header text-primary my-auto">
                <h3>Calificaciones</h3>
                <h5 class="text-muted ts-5 my-0 ">{{$persona->nombre}} {{$persona->apellido}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col" style="min-width: 400px">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between px-4">
                                <span class="text-primary fw-bold fs-5">Notas cuaderno de seguimiento</span>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="fw-bold">Esfuerzo y regularidad</td>
                                        <td>
                                            <label
                                                id="esfuerzo">{{$calificaciones_teoricas['seguimiento'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Orden, estructura y presentación</td>
                                        <td>
                                            <label
                                                id="orden">{{$calificaciones_teoricas['orden'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Contenido</td>
                                        <td>
                                            <label
                                                id="contenido">{{$calificaciones_teoricas['contenido'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Terminología y notación</td>
                                        <td>
                                            <label
                                                id="notacion">{{$calificaciones_teoricas['terminologia'] ?? "Sin datos"}}</label>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Calidad en el trabajo</td>
                                        <td>
                                            <label
                                                id="calidadTrabajo">{{$calificaciones_teoricas['calidad'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Relaciona conceptos</td>
                                        <td>
                                            <label
                                                id="relacionar">{{$calificaciones_teoricas['conceptos'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Reflexión sobre el aprendizaje</td>
                                        <td>
                                            <label
                                                id="reflexion">{{$calificaciones_teoricas['reflexion'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="min-width: 400px">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between px-4">
                                <span class="text-primary fw-bold fs-5">Notas empresa</span>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="fw-bold">Actitud y disposición para el trabajo</td>
                                        <td>
                                            <label
                                                id="actitud">{{$calificaciones_practicas['actitud'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Puntualidad</td>
                                        <td>
                                            <label id="puntual">{{$calificaciones_practicas['puntualidad'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Responsabilidad</td>
                                        <td>
                                            <label id="responsabilidad">{{$calificaciones_practicas['responsabilidad'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de resolución de problemas</td>
                                        <td>
                                            <label id="resolucion">{{$calificaciones_practicas['capacidad_resolucion'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Calidad en el trabajo</td>
                                        <td>
                                            <label id="calidad">{{$calificaciones_practicas['calidad_trabajo'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Implicación e integración en el equipo</td>
                                        <td>
                                            <label id="instegracion">{{$calificaciones_practicas['implicación'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Toma de decisiones</td>
                                        <td>
                                            <label id="decisiones">{{$calificaciones_practicas['decisiones'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de comunicación oral y escrita</td>
                                        <td>
                                            <label id="escrita">{{$calificaciones_practicas['capacidad_oral'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de planificación y organización</td>
                                        <td>
                                            <label id="organizacion">{{$calificaciones_practicas['capacidad_planificacion'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de aprendizaje y asimilación</td>
                                        <td>
                                            <label id="asimilacion">{{$calificaciones_practicas['capacidad_aprendizaje'] ?? "Sin datos"}}</label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-evenly col-12">
                    <label class="text-primary fw-bold text-decoration-underline">Nota final: {{empty($calificacion_total) ? "Sin datos" : $calificacion_total }}</label>
                </div>
            </div>
        </div>
    </div>
@endsection
