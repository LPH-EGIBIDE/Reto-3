@extends('layouts.app')

@section('scripts')
    @vite('resources/js/editElement.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection


@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header d-flex align-items-center justify-content-between px-4">
            <span class="text-primary fw-bold fs-3">Ver familia</span>
            <div class="d-flex gap-3">
                <button type="button" id="editButton" class="btn btn-primary p-2 px-3">
                    <span class="d-none d-md-block">Editar</span>
                    <i class="fa-solid fa-pencil d-block d-md-none"></i>
                </button>
                <form action="{{ route('familia.destroy', ["id" => $familia->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="deleteButton" class="btn btn-danger p-2 px-3">
                        <span class="d-none d-md-block">Borrar</span>
                        <i class="fa-solid fa-cross d-block d-md-none"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body d-flex flex-row justify-content-around gap-2">
            <div class="col-md-7 col-6">
                <form id="editForm" action="{{route('familia.update',['id'=> $familia->id])}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" value="{{$familia->nombre}}" disabled class="form-control" id="nombre">
                    </div>
                    <div class="d-flex justify-content-end col-12">
                        <button type="submit" disabled class="btn btn-success p-2 px-3">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
