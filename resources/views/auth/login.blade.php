@extends('layouts.auth')

@section('content')
    <div class="row d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="col-sm-6 mx-auto">
            <div class="errors mb-3">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Error!</strong> {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-center mb-5">
                <img class="logo" src="{{asset('images/logo.png')}}" alt="Logo egibide" srcset="/img/logo.png 2x">
            </div>
            <div class="card">
                <div class="card-header">Iniciar sesión</div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="email">Correo de Egibide</label>
                            <input type="text" autocomplete="off" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="mc-user" placeholder="Correo electronico">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="contra" class="form-control" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                        </div>
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rememberMe">
                                            Mantener sesión iniciada
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success form-control" style="background-color: #1a459a; border-color: transparent;">Iniciar sesión <i class="fas fa-chevron-right"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            <a href="{{route('password.request')}}">¿Has olvidado tu contraseña?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


