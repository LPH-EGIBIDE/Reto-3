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
                <div class="card-header">Recuperar contraseña</div>
                <div class="card-body">
                    <form action="{{ route('password.email') }}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="email">Correo electronico</label>
                            <input type="text" autocomplete="off" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="user" placeholder="Correo electronico">
                        </div>
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center justify-content-center"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-success form-control" style="background-color: #1a459a; border-color: transparent;">Recuperar <i class="fas fa-chevron-right"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
