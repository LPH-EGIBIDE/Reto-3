<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar Pocho</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Item pocho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link pocho</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown pocho
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Bolas</a></li>
                        <li><a class="dropdown-item" href="#">de</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Mono</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Deshabilitado pocho</a>
                </li>
            </ul>
            <div class="d-flex justify-content-evenly justify-content-lg-start">
                <div class="dropdown">
                    <button class="btn dropdown-toggle text-bg-light" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-bell"></i></button>
                    <ul class="dropdown-menu notifications dropdown-menu-lg-end dropdown-menu-start top-head-dropdown">
                        <li>
                            <a href="#" class="top-text-block">
                                <div class="top-text-heading">
                                    <b>Debes rellenar tu cuaderno de practicas</b>
                                </div>
                                <div class="top-text-light">Hace 10 minutos</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn text-bg-light mx-lg-2" type="submit"><i class="fa-solid fa-envelope"></i></button>
                <form class="d-flex" action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn text-bg-danger" type="submit"><i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
