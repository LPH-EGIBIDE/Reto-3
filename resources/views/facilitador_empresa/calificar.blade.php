@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container d-flex flex-row align-items-center justify-content-center">
        <div class="card col-12 col-lg-8 p-0">
            <div class="card-header text-primary my-auto">
                <h3>Evaluación de trabajo en empresa</h3>
                <p class="text-muted ts-6 my-0">{{$persona->nombre}} {{$persona->apellido}}</p>
            </div>
            <form class="form" action="{{ route('alumno.calificar', ["id"=>$persona->id], false) }}" method="post">
                @csrf
                <div class="card-body d-flex justify-content-center">
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <tr>
                                    <td>Actitud y disposición para el trabajo</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_1">
                                            <option @if(($calificacion['actitud'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                            <option @if(($calificacion['actitud'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['actitud'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['actitud'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['actitud'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['actitud'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Puntualidad</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_2">
                                            <option @if(($calificacion['puntualidad'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                            <option @if(($calificacion['puntualidad'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['puntualidad'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['puntualidad'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['puntualidad'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['puntualidad'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Responsabilidad</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_3">
                                            <option @if(($calificacion['responsabilidad'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                            <option @if(($calificacion['responsabilidad'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['responsabilidad'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['responsabilidad'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['responsabilidad'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['responsabilidad'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de resolución de problemas</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_4">
                                            <option @if(($calificacion['capacidad_resolucion'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                            <option @if(($calificacion['capacidad_resolucion'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['capacidad_resolucion'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['capacidad_resolucion'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['capacidad_resolucion'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['capacidad_resolucion'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Calidad en el trabajo</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_5">
                                            <option @if(($calificacion['calidad_trabajo'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                            <option @if(($calificacion['calidad_trabajo'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['calidad_trabajo'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['calidad_trabajo'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['calidad_trabajo'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['calidad_trabajo'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-responsive">
                                <tr>
                                    <td>Implicación e integración en el equipo</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_6">
                                            <option @if(($calificacion['implicación'] ?? -1) == -1) selected @endif value="-1">Seleccionar</option>
                                            <option @if(($calificacion['implicación'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['implicación'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['implicación'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['implicación'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['implicación'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Toma de decisiones</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_7">
                                            <option @if(($calificacion['decisiones'] ?? -1) == -1) selected @endif value="-1">Seleccionar</option>
                                            <option @if(($calificacion['decisiones'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['decisiones'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['decisiones'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['decisiones'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['decisiones'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de comunicación oral y escrita</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_8">
                                            <option @if(($calificacion['capacidad_oral'] ?? -1) == -1) selected @endif value="-1">Seleccionar</option>
                                            <option @if(($calificacion['capacidad_oral'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['capacidad_oral'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['capacidad_oral'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['capacidad_oral'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['capacidad_oral'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de planificación y organización.</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_8">
                                            <option @if(($calificacion['capacidad_planificacion'] ?? -1) == -1) selected @endif value="-1">Seleccionar</option>
                                            <option @if(($calificacion['capacidad_planificacion'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['capacidad_planificacion'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['capacidad_planificacion'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['capacidad_planificacion'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['capacidad_planificacion'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de aprendizaje y asimilación</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="calificacion_10">
                                            <option @if(($calificacion['capacidad_aprendizaje'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                            <option @if(($calificacion['capacidad_aprendizaje'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                            <option @if(($calificacion['capacidad_aprendizaje'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                            <option @if(($calificacion['capacidad_aprendizaje'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                            <option @if(($calificacion['capacidad_aprendizaje'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <input class="btn btn-primary" type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </div>
@endsection
