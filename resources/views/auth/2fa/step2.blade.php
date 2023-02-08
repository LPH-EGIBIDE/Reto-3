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
                        <div class="row">
                            <div class="col-md-10 mb-md-2">
                                <div id="codeHelpBlock" class="form-text">
                                    Escanea el código QR con la aplicación de autenticación de dos factores.
                                </div>
                                <div class="form-text">
                                    Introduce el código de verificación de la aplicación para continuar.
                                </div>
                            </div>
                            <div class="col-lg-6 d-lg-block d-flex justify-content-center">
                                {!! $QR_Image !!}
                            </div>
                            <div class="col-lg-6 ">
                                <form action="{{route('2fa.enable.step-2')}}" method="post">
                                    @csrf
                                    <label for="inputCode" class="form-label">Código de verificación de la aplicación</label>
                                    <input type="text" id="inputCode" class="form-control mb-2"
                                           aria-describedby="codeHelpBlock" name="2fa" min="100000" max="999999">
                                    <button type="submit" class="btn btn-primary">Continuar</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
