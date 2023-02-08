<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between p-3">
            <h5 class="my-auto text-primary fs-3">Lista de alumnos</h5>
            @can('is_coordinador')
            <form action="{{ route('alumno.api.listado.coordinador') }}" method="get" id="filterForm">
            @else
            <form action="{{ route('alumno.api.listado') }}" method="get" id="filterForm">
            @endcan
                <input type="hidden" name="page" id="pageForm" value="1">
            </form>
        </div>
        <div class="card-body bg-light table-responsive">
            <table class="table">
                <thead class="text-primary">
                <tr>
                    <th scope="col" class="border-dark">Nombre</th>
                    <th scope="col" class="border-dark">Apellido</th>
                    <th scope="col" class="border-dark">DNI</th>
                    <th scope="col" class="border-dark">Empresa</th>
                    <th scope="col" class="border-dark">Correo</th>
                    <th scope="col" class="border-dark">Acciones</th>
                </tr>
                </thead>
                <tbody id="itemTable">
                    @for($i = 0; $i < 4; $i++)
                        <tr class="loading-skeleton">
                            <td><p>Mireille</p></td>
                            <td><p>Marvin</p></td>
                            <td><p>12345678A/p></td>
                            <td><p>Deckow, Runolfsson and Jaskolski</p></td>
                            <td><p>hershel.heidenreich@example.net</p></td>
                            <td><p>Hola mama</p></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <p id="noItems"  class="text-center d-none">No hay alumnos que mostrar</p>
        </div>
        <div class="card-footer">
         <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end my-auto">
                    <li class="page-item">
                        @can('is_coordinador')
                            <a class="page-link" href="{{route('alumno.index.coordinador')}}">
                                Ver mas...
                            </a>
                        @else
                        <a class="page-link" href="{{route('alumno.index')}}">
                            Ver mas...
                        </a>
                        @endcan
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
