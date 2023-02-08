

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="text-primary my-auto">Grados que coordina</h3>
    </div>
    <div class="card-body bg-light table-responsive">
        <table class="table text-center">
            <thead class="text-primary">
            <tr>
                <th scope="col" class="border-dark">Nombre</th>
                <th scope="col" class="border-dark">Familia</th>
                <th scope="col" class="border-dark">Acciones</th>
            </tr>
            </thead>
            <tbody id="itemTable">
            @foreach($facilitadorCentro->grado as $grado)
                <tr>
                    <td><p>{{$grado->nombre}}</p></td>
                    <td><p>{{$grado->familia->nombre}}</p></td>
                        <td>
                            <a href="{{ route('grado.show', $grado->id, false) }}" class="btn btn-primary ">
                                <i class="fa-solid fa-eye me-1 "></i>
                                <span>Ver</span>
                            </a>
                        </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

