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
                                                id="esfuerzo">{{$nombre_calificaciones[$calificaciones_teoricas['seguimiento'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Orden, estructura y presentación</td>
                                        <td>
                                            <label
                                                id="orden">{{$nombre_calificaciones[$calificaciones_teoricas['orden'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Contenido</td>
                                        <td>
                                            <label
                                                id="contenido">{{$nombre_calificaciones[$calificaciones_teoricas['contenido'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Terminología y notación</td>
                                        <td>
                                            <label
                                                id="notacion">{{$nombre_calificaciones[$calificaciones_teoricas['terminologia'] ?? 5]}}</label>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Calidad en el trabajo</td>
                                        <td>
                                            <label
                                                id="calidadTrabajo">{{$nombre_calificaciones[$calificaciones_teoricas['calidad'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Relaciona conceptos</td>
                                        <td>
                                            <label
                                                id="relacionar">{{$nombre_calificaciones[$calificaciones_teoricas['conceptos'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Reflexión sobre el aprendizaje</td>
                                        <td>
                                            <label
                                                id="reflexion">{{$nombre_calificaciones[$calificaciones_teoricas['reflexion'] ?? 5]}}</label>
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
                                                id="actitud">{{$nombre_calificaciones[$calificaciones_practicas['actitud'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Puntualidad</td>
                                        <td>
                                            <label id="puntual">{{$nombre_calificaciones[$calificaciones_practicas['puntualidad'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Responsabilidad</td>
                                        <td>
                                            <label id="responsabilidad">{{$nombre_calificaciones[$calificaciones_practicas['responsabilidad'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de resolución de problemas</td>
                                        <td>
                                            <label id="resolucion">{{$nombre_calificaciones[$calificaciones_practicas['capacidad_resolucion'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Calidad en el trabajo</td>
                                        <td>
                                            <label id="calidad">{{$nombre_calificaciones[$calificaciones_practicas['calidad_trabajo'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Implicación e integración en el equipo</td>
                                        <td>
                                            <label id="instegracion">{{$nombre_calificaciones[$calificaciones_practicas['implicación'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Toma de decisiones</td>
                                        <td>
                                            <label id="decisiones">{{$nombre_calificaciones[$calificaciones_practicas['decisiones'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de comunicación oral y escrita</td>
                                        <td>
                                            <label id="escrita">{{$nombre_calificaciones[$calificaciones_practicas['capacidad_oral'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de planificación y organización</td>
                                        <td>
                                            <label id="organizacion">{{$nombre_calificaciones[$calificaciones_practicas['capacidad_planificacion'] ?? 5]}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Capacidad de aprendizaje y asimilación</td>
                                        <td>
                                            <label id="asimilacion">{{$nombre_calificaciones[$calificaciones_practicas['capacidad_aprendizaje'] ?? 5]}}</label>
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
