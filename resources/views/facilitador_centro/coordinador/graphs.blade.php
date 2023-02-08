<div class="container d-flex justify-content-center w-100">
    <div class="card w-100">
        <div class="card-header d-flex align-items-center gap-2">
            @if($persona->profile_pic_id != null)
                <img src="{{route('attachment.show.custom', [$persona->profile_pic_id, 100,100])}}" class="rounded-circle" alt="Imagen usuario" >
            @else
                <img src="{{Vite::asset('resources/images/profile.jpg')}}" class="rounded-circle" alt="Imagen usuario" style="height: 100px">
            @endif
            <span class="card-title text-primary m-0 fs-2 fw-bold">Ficha de coordinador</span>
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
    <div class="card" style=" height:30vh; width:50vw;" >
        <canvas id="chart_1" class="h-100"></canvas>
        <script>
            let ctx = document.getElementById('chart_1').getContext('2d');
            let chart = new Chart(ctx, {
                //Doughnut chart type, 2 datasets, 'alumnos sin empresa' and 'alumnos con empresa'
                type: 'doughnut',
                data: {
                    labels: ['Alumnos sin empresa', 'Alumnos con empresa'],
                    datasets: [{
                        label: 'Alumnos',
                        backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                        borderColor: 'rgb(255, 255, 255)',
                        data: [{{$alumnos_sin_empresa}}, {{$alumnos_con_empresa}}]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        </script>
    </div>
</div>
