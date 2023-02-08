

@section('scripts')
    @vite('resources/js/filterElement.ts')
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@include('facilitador_centro.coordinador.graphs');

@include('alumno.smallList');
