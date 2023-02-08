<div class="container d-flex justify-content-center w-100">
    <div class="card w-100">
    </div>
      <div class="card" style=" height:30vh; width:50vw;" >
          <canvas id="chart_1"></canvas>
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
