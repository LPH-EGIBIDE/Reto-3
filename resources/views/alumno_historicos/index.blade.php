<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="text-primary my-auto">Lista históricos</h3>
        </div>
        <div class="card-body bg-light table-responsive">
            <table class="table">
                <thead class="text-primary">
                <tr>
                    <th scope="col" class="border-dark">Curso</th>
                    <th scope="col" class="border-dark">Grado</th>
                    <th scope="col" class="border-dark">Fac. centro</th>
                    <th scope="col" class="border-dark">Fac. empresa</th>
                    <th scope="col" class="border-dark">Empresa</th>
                    <th scope="col" class="border-dark">Estado</th>
                    <th scope="col" class="border-dark">Acciones</th>
                </tr>
                </thead>
                <tbody id="itemTable">
                @for($i = 0; $i < 10; $i++)
                    <tr class="loading-skeleton">
                        <td><p>22/23</p></td>
                        <td><p>1º Ingeniería Informática</p></td>
                        <td><p>Manu Guerrero</p></td>
                        <td><p>Lia Sikora</p></td>
                        <td><p>Harbour Corporation</p></td>
                        <td><p>Cursando</p></td>
                        <td><p>Acción</p></td>
                    </tr>
                @endfor
                </tbody>
            </table>
            <p id="noItems"  class="text-center d-none">No hay alumnos que coincidan</p>
        </div>
        <div class="card-footer">
            <nav>
                <ul class="pagination justify-content-end my-auto">
                    <li class="page-item">
                        <a class="page-link" id="previousPage" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link disabled" disabled id="page" href="#">1</a>
                    </li>
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
