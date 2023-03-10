@vite('resources/js/notificationList.ts')

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{Vite::asset('resources/images/logo-sm.png')}}" alt="Logo" class="logo" width="30" height="44">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}"><i class="fa-regular fa-house pe-2"></i>Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route("profile.show")}}"><i class="fa-regular fa-address-card pe-2"></i>Perfil</a>
                </li>

                @can('facilitador')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('alumno.calificar.index')}}"><i class="fa-regular fa-user-graduate pe-2"></i>Calificaciones</a>
                    </li>
                @endcan

                @can('alumno')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('alumno.calificaciones')}}"><i class="fa-regular fa-user-graduate pe-2"></i>Calificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cuaderno.index')}}"><i class="fa-regular fa-notebook pe-2"></i>Cuaderno Equipo</a>
                    </li>
                @endcan

                @can('facilitador_empresa')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('alumno.index')}}"><i class="fa-regular fa-screen-users pe-2"></i>Mis alumnos</a>
                </li>
                @endcan
                @can('facilitador_centro')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('alumno.index')}}"><i class="fa-regular fa-screen-users pe-2"></i>Mis alumnos</a>
                </li>
                @endcan

                @can('is_coordinador')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Coordinaci??n
                        </a>
                        <ul class="dropdown-menu dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('alumno.index.coordinador')}}">Alumnos</a>
                            <li><a class="dropdown-item" href="{{route('curso.index')}}">Cursos</a></li>
                            <li><a class="dropdown-item" href="{{route('facilitador-centro.index')}}">Fac. Centro</a></li>
                            <li><a class="dropdown-item" href="{{route('empresa.index')}}">Empresas</a></li>
                            <li><a class="dropdown-item" href="{{route('facilitador-empresa.index')}}">Fac. Empresa</a></li>
                            <li><a class="dropdown-item" href="{{route('grado.index')}}">Grados</a></li>
                            <li><a class="dropdown-item" href="{{route('familia.index')}}">Familias</a></li>
                        </ul>
                    </li>
                @endcan
            </ul>
            <div class="d-flex justify-content-evenly justify-content-lg-start">
                <div class="dropdown">
                    <button class="btn dropdown-toggle text-bg-light" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-bell"></i></button>
                    <ul class="dropdown-menu notifications dropdown-menu-lg-end dropdown-menu-start top-head-dropdown" id="notification-list">
                    </ul>
                </div>
                <div class="mx-lg-2"></div>
                @can('facilitador')
                    <a class="btn text-bg-light" href="{{route('mensaje.index')}}"><i class="fa-solid fa-envelope"></i></a>
                    <div class="mx-lg-2"></div>
                @endcan
                <form class="d-flex" action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn text-bg-danger" type="submit"><i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
