@extends('layouts.app')

@section('scripts')
    @vite('resources/js/filterElement.ts')
@endsection

@section('navbar')
    @include('navbar')
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between p-3">
                <h5 class="my-auto text-primary fs-4 d-none d-lg-block">Lista de facilitadores de centro</h5>
                <p class="my-auto fw-bold text-primary d-lg-none">Fac. de centro</p>
                <form action="{{route('facilitador-centro.api.listado')}}" method="get" id="filterForm">
                    <input type="hidden" name="page" id="pageForm" value="1">
                    <div class="input-group ml-auto w-auto d-flex flex-row">
                        <div class="form-outline">
                            <input type="search" id="form1" name="filtro" class="form-control" placeholder="Buscar"/>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body bg-light table-responsive">
                <table class="table">
                    <thead class="text-primary">
                    <tr>
                        <th scope="col" class="border-dark">Nombre</th>
                        <th scope="col" class="border-dark">Apellido</th>
                        <th scope="col" class="border-dark">DNI</th>
                        <th scope="col" class="border-dark">Teléfono</th>
                        <th scope="col" class="border-dark">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="itemTable">
                    @for($i = 0; $i < 10; $i++)
                        <tr class="loading-skeleton">
                            <td><p>Mireille</p></td>
                            <td><p>Marvin</p></td>
                            <td><p>12345678A/p></td>
                            <td><p>1º Ingenieria informatica</p></td>
                            <td><p>Ver</p></td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                <p id="noItems"  class="text-center d-none">No hay facilitadores que coincidan</p>
            </div>
            <div class="card-footer">
                <nav>
                    <ul class="pagination justify-content-end my-auto">
                        <li class="page-item">
                            <a class="page-link" id="previousPage"  href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" ><a class="page-link disabled" disabled id="page" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" id="nextPage" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
