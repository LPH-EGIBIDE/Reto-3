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
            <form class="form">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Esfuerzo y regularidad</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota1">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Orden, estructura y presentación</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota2">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota3">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Terminología y notación</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota4">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Calidad en el trabajo</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota5">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Relaciona conceptos</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota6">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Reflexión sobre el aprendizaje</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="nota7">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <input class="btn btn-primary" type="submit" value="Publicar">
                </div>
            </form>
        </div>
    </div>
@endsection
