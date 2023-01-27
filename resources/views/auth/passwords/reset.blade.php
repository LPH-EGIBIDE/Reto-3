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
                <img class="logo" src="{{asset('images/logo.png')}}" alt="Logo egibide" srcset="/img/logo.png 2x">
            </div>
            <div class="card">
                <div class="card-header">Recuperar contraseña</div>
                <div class="card-body">
                    <form  action="{{ route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                        <div class="form-group mb-2">
                            <label for="email">{{ __('Password') }}</label>
                            <input type="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" autocomplete="off" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                        </div>
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center justify-content-center"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-success form-control" style="background-color: #1a459a; border-color: transparent;">{{ __('Reset Password') }} <i class="fas fa-chevron-right"></i></button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
