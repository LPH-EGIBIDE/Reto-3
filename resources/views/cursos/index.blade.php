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
                <h5 class="my-auto text-primary fs-4 d-none d-md-block">Lista de cursos</h5>
                <p class="my-auto fw-bold text-primary d-md-none">Cursos</p>
                <div class="d-flex">
                    <a href="{{ route('curso.create') }}" class="btn btn-primary me-1 me-lg-3">
                        <i class="fas fa-plus me-1"></i>Crear
                    </a>
                    <form action="{{ route('cursos.api.listado') }}" method="get" id="filterForm">
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
            </div>
            <div class="card-body bg-light overflow-hidden">
                <table class="table table-responsive">
                    <thead class="text-primary">
                    <tr>
                        <th scope="col" class="border-dark">Nombre</th>
                        <th scope="col" class="border-dark">Fecha de inicio</th>
                        <th scope="col" class="border-dark">Fecha de fin</th>
                        <th scope="col" class="border-dark">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="itemTable">
                    @for($i = 0; $i < 10; $i++)
                        <tr class="loading-skeleton">
                            <td><p>84563255H</p></td>
                            <td><p>Manolito</p></td>
                            <td><p>Ingeniería xd/p></td>
                            <td><p>Acciones</p></td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                <p id="noItems"  class="text-center d-none">No hay cursos que coincidan</p>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
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
