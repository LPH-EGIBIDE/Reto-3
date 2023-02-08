<div class="container d-flex flex-column justify-content-evenly">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center gap-2">
            @if($persona->profile_pic_id != null)
                <img src="{{route('attachment.show.custom', [$persona->profile_pic_id, 100,100])}}" class="rounded-circle" alt="Imagen usuario" >
            @else
                <img src="{{Vite::asset('resources/images/profile.jpg')}}" class="rounded-circle" alt="Imagen usuario" style="height: 100px">
            @endif
            <span class="card-title text-primary m-0 fs-2 fw-bold">Ficha de facilitador de empresa</span>
        </div>
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table">
                            <thead class="text-primary">
                            <tr>
                                <th class="border-dark">Datos del facilitador</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <ul class="list-group list-group-flush text-break">
                                        <li class="list-group-item">Nombre: {{$persona->nombre}} {{$persona->apellido}}</li>
                                        <li class="list-group-item">DNI: {{$persona->dni}}</li>
                                        <li class="list-group-item">Email: {{$persona->informacion->user->email}}</li>
                                        <li class="list-group-item">Teléfono: {{$persona->telefono}}</li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-responsive">
                            <thead class="text-primary">
                            <tr>
                                <th class="border-dark">Datos de empresa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <ul class="list-group list-group-flush text-break">
                                        <li class="list-group-item">Nombre: {{$persona->informacion->empresa->nombre}}</li>
                                        <li class="list-group-item">CIF: {{$persona->informacion->empresa->cif}}</li>
                                        <li class="list-group-item">Dirección: {{$persona->informacion->empresa->direccion}}</li>
                                        <li class="list-group-item">Teléfono: {{$persona->informacion->empresa->telefono}}</li>
                                        <li class="list-group-item">Área: {{$persona->informacion->empresa->area}}</li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center gap-2">
            <h5 class="my-auto text-primary fs-3">Alumnos coordinador</h5>
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
                @for($i = 0; $i < 5; $i++)
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
            <p id="noItems"  class="text-center d-none">No tiene alumnos a su cargo</p>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{route('alumno.index')}}">
                <button class="btn btn-success">Ver todos</button>
            </a>
        </div>
    </div>
</div>
