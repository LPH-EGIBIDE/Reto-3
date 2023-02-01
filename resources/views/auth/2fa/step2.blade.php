@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container">
        {!! $QR_Image !!}
    </div>
@endsection
