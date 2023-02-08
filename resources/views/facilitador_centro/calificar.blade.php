@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center flex-row">
        <div class="card col-12 col-lg-8 p-0">
            <div class="card-header text-primary my-auto">
                <h3>Evaluación de diario de aprendizaje</h3>
                <p class="text-muted ts-6 my-0">{{$persona->nombre}} {{$persona->apellido}}</p>
            </div>
            <form class="form" action="{{ route('alumno.calificar', ["id"=>$persona->id], false) }}" method="post">
                @csrf
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Esfuerzo y regularidad</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_1">
                                    <option @if(($calificacion['seguimiento'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['seguimiento'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['seguimiento'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['seguimiento'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['seguimiento'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['seguimiento'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Orden, estructura y presentación</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_2">
                                    <option @if(($calificacion['orden'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['orden'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['orden'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['orden'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['orden'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['orden'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_3">
                                    <option @if(($calificacion['contenido'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['contenido'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['contenido'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['contenido'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['contenido'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['contenido'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Terminología y notación</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_4">
                                    <option @if(($calificacion['terminologia'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['terminologia'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['terminologia'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['terminologia'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['terminologia'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['terminologia'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Calidad en el trabajo</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_5">
                                    <option @if(($calificacion['calidad'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['calidad'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['calidad'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['calidad'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['calidad'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['calidad'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Relaciona conceptos</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_6">
                                    <option @if(($calificacion['conceptos'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['conceptos'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['conceptos'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['conceptos'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['conceptos'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['conceptos'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Reflexión sobre el aprendizaje</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="calificacion_7">
                                    <option @if(($calificacion['reflexion'] ?? -1) == -1) selected @endif disabled value="-1">Seleccionar</option>
                                    <option @if(($calificacion['reflexion'] ?? -1) == 0) selected @endif value="0">Insuficiente</option>
                                    <option @if(($calificacion['reflexion'] ?? -1) == 1) selected @endif value="1">Suficiente</option>
                                    <option @if(($calificacion['reflexion'] ?? -1) == 2) selected @endif value="2">Bien</option>
                                    <option @if(($calificacion['reflexion'] ?? -1) == 3) selected @endif value="3">Notable</option>
                                    <option @if(($calificacion['reflexion'] ?? -1) == 4) selected @endif value="4">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <input class="btn btn-primary" type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </div>
@endsection
