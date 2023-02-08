@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container h-100 ">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="errors mb-3">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Error!</strong> {{ $error }}
                        </div>
                    @endforeach
                @endif
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Exito!</strong> {{ session('status') }}
                    </div>
                @endif

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Activar autenticación de dos factores
                    </div>
                    <div class="card-body">

                        <form action="{{route('2fa.disable')}}" method="post">
                            @csrf
                            <div id="passwordHelpBlock" class="form-text">
                                Es necesario que introduzcas tu contraseña para poder continuar.
                            </div>
                            <label for="inputPassword5" class="form-label">Contraseña</label>
                            <input type="password" id="inputPassword5" class="form-control mb-2"
                                   aria-describedby="passwordHelpBlock" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                            <div class="d-flex flex-row justify-content-evenly">
                                <button type="submit" class="btn btn-danger">Deshabilitar</button>
                                <a href="{{route('index')}}" class="btn btn-primary">Volver atrás</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
