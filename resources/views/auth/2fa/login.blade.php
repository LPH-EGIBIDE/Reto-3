@extends('layouts.auth')


@section('content')
    <div class="row d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="col-lg-6 mx-auto">
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
            <div class="text-center mb-5">
                <img class="logo" src="{{asset('images/logo.png')}}" alt="Logo" srcset="/img/logo.png 2x">
            </div>
            <div class="card">
                <div class="card-header">Verificacion en 2 pasos</div>
                <div class="card-body">
                    <form action="{{ route('auth.2fa') }}" method="post">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="2fa">Introduce el código generado por tu aplicación de autenticación</label>
                            <input type="text" autocomplete="off" class="form-control @error('2fa') is-invalid @enderror" name="2fa" id="2fa" placeholder="Código de la aplicación de autenticación">
                        </div>
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-success form-control" style="background-color: #1a459a; border-color: transparent;">Iniciar sesión <i class="fas fa-chevron-right"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
