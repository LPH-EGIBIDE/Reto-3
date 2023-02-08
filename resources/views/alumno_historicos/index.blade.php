

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="text-primary my-auto">Lista históricos</h3>
            <a href="{{ route('alumnohistorico.create') }}" class="btn btn-primary me-1 me-lg-3">
                <i class="fas fa-plus me-1"></i>Crear
            </a>
        </div>
        <div class="card-body bg-light table-responsive">
            <table class="table text-center">
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
                @foreach($alumno->alumnoHistorico as $alumnoHistorico)
                    <tr>
                        <td><p>{{$alumnoHistorico->curso->nombre}}</p></td>
                        <td><p>{{$alumnoHistorico->grado->nombre}}</p></td>
                        <td><p>{{$alumnoHistorico->facilitadorCentro->persona->nombre}} {{$alumnoHistorico->facilitadorCentro->persona->apellido}}</p></td>
                        <td><p>{{$alumnoHistorico->facilitadorEmpresa->persona->nombre}} {{$alumnoHistorico->facilitadorEmpresa->persona->apellido}}</p></td>
                        <td><p>{{$alumnoHistorico->facilitadorEmpresa->empresa->nombre}}</p></td>
                        <td><p><span class="badge text-bg-{{$estados[$alumnoHistorico->estado]}}">{{ucfirst($alumnoHistorico->estado)}}</span></p></td>
                        @if($alumnoHistorico->curso == \App\Models\Curso::getActiveCurso())
                            <td class="d-flex flex-row align-items-center justify-content-center">
                                <a href="{{route('alumnohistorico.update', ["id" => $alumnoHistorico->id])}}" class="btn btn-primary d-flex ">
                                    <i class="fa-solid fa-pencil me-1"></i>
                                    <span class="d-none d-lg-block">Editar</span>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if(empty($alumno->alumnoHistorico))
                <p id="noItems" class="text-center">No hay históricos</p>
            @endif
        </div>
    </div>

