@extends('layouts.app')

@section('navbar')
    @include('navbar')
@endsection

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header d-flex justify-content-between px-4">
            <span class="text-primary fw-bold fs-3">Añadir empresa</span>

        </div>
        <div class="card-body d-flex flex-row justify-content-around gap-2">

            <div class="col-md-7 col-6">
                <form action="{{route('empresa.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion">
                    </div>
                   <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text"  class="form-control" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="cif" class="form-label">CIF</label>
                        <input type="text"  class="form-control" name="cif">
                  </div>
                  <div class="mb-4">
                        <label for="area" class="form-label">Area</label>
                        <input type="text"  class="form-control" name="area">
                    </div>

                    <div class="d-flex justify-content-end col-12">
                        <button type="submit"  class="btn btn-success p-2 px-3">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
