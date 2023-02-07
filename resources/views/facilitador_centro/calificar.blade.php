@extends('layouts.app')
@section('navbar')
    @include('navbar')
@endsection

@section('container')
    <div class="container d-flex flex-row align-items-center justify-content-center">
        <div class="card col-12 col-lg-8 p-0">
            <div class="card-header text-primary my-auto">
                <h3>Evaluación de trabajo en empresa</h3>
                <p class="text-muted ts-6 my-0">{{$persona->nombre}} {{$persona->apellido}}</p>
            </div>
            <form class="form">
                <div class="card-body d-flex justify-content-center">
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <tr>
                                    <td>Actitud y disposición para el trabajo</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota1">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Puntualidad</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota2">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Responsabilidad</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota3">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de resolución de problemas</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota4">
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
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota5">
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
                        <div class="col">
                            <table class="table table-responsive">
                                <tr>
                                    <td>Implicación e integración en el equipo</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota6">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Toma de decisiones</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota7">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de comunicación oral y escrita</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota8">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de planificación y organización.</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota9">
                                            <option value="insuficiente">Insuficiente</option>
                                            <option value="suficiente">Suficiente</option>
                                            <option value="bien">Bien</option>
                                            <option value="notable">Notable</option>
                                            <option value="sobresaliente">Sobresaliente</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de aprendizaje y asimilación</td>
                                    <td>
                                        <select class="form-select form-select-sm w-auto ms-auto" name="nota10">
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
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <input class="btn btn-primary" type="submit" value="Publicar">
                </div>
            </form>
        </div>
    </div>
@endsection
