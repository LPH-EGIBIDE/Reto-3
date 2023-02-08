@extends('layouts.app')

@section('scripts')
    @vite('resources/js/cuadernoAlumno.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container">
        @include('alerts')
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="container row-separation">
                    <div class="row">
                        <h2 class="my-auto text-primary">Cuaderno de seguimiento</h2>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <p class="text-muted">{{$persona->nombre}} {{$persona->apellido}}</p>
                        </div>
                        <div class="col-6">
                            <div class="input-group ml-auto w-auto">
                                <form class="d-flex flex-row align-items-center gap-2" id="formWeek" action="{{route('cuaderno.api.semana')}}">
                                    <label for="semanaSelect" class="fw-bold">Semana:</label>
                                    <select name="semana" id="semanaSelect" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected value="">Elige una semana</option>
                                        @foreach($weeks as $week)
                                            <option value="{{$week[0]}}">{{$week[1]}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <form class="evaCS" action="{{ route('cuaderno.evaluar', [$persona->id], false) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="semana" value="" id="semanaHidden">
                    <div class="form-outline">
                        <label class="form-label fw-bold text-decoration-underline" for="textAreaObservaciones">Observaciones del tutor</label>
                        <textarea class="form-control" name="observaciones" id="textAreaObservaciones" rows="5"></textarea>
                    </div>
                    <hr>
                    <div class="form-outline">
                        <label class="form-label fw-bold text-decoration-underline" for="textAreaActividades">Actividades desarrolladas</label>
                        <textarea disabled class="form-control" id="textAreaActividades" rows="10" placeholder="Actividades realizadas en la empresa, tareas relacionadas con la asignatura dual, formaciones."></textarea>
                    </div>
                    <hr>
                    <div class="form-outline">
                        <label class="form-label fw-bold text-decoration-underline" for="textAreaReflexion">Reflexión sobre el aprendizaje y progreso realizado en la empresa</label>
                        <textarea disabled class="form-control" id="textAreaReflexion" rows="10" placeholder="¿Qué competencias he trabajado? ¿Qué he aprendido? ¿Cuáles son los aspectos en los que he progresado?"></textarea>
                    </div>
                    <hr>
                    <div class="form-outline">
                        <label class="form-label fw-bold text-decoration-underline" for="textAreaProblemas">Identificación de problemas o dificultades y acciones de mejora a poner en marcha</label>
                        <textarea disabled class="form-control"  id="textAreaProblemas" rows="10" ></textarea>
                    </div>
                    <hr>
                    <nav aria-label="Page navigation example" class="form-footer evaCSFormFooter">
                        <button type="submit" class="btn btn-success">Evaluar</button>
                    </nav>
                </form>
            </div>
        </div>
    </div>
@endsection
