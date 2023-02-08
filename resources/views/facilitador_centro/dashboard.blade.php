@section('scripts')
    @vite('resources/js/filterElement.ts')
@endsection


<div class="container d-flex justify-content-center mb-3 w-100">
    <div class="card col-lg-10 col-12">
        <div class="card-header d-flex align-items-center gap-2">
            @if($persona->profile_pic_id != null)
                <img src="{{route('attachment.show.custom', [$persona->profile_pic_id, 100,100])}}" class="rounded-circle" alt="Imagen usuario" >
            @else
                <img src="{{Vite::asset('resources/images/profile.jpg')}}" class="rounded-circle" alt="Imagen usuario" style="height: 100px">
            @endif
            <span class="card-title text-primary m-0 fs-2 fw-bold">Ficha de facilitador centro</span>
        </div>
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table">
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
                </div>
            </div>
        </div>
    </div>
</div>

@include('alumno.smallList');
