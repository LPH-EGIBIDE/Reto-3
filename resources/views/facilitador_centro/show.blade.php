<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header d-flex align-items-center justify-content-between px-4">
            <span class="text-primary fw-bold fs-5">Vista del facilitador del centro</span>
            @can('is_coordinador')
                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-primary p-2 px-3">
                        <span class="d-none d-md-block">Editar</span>
                        <i class="fa-solid fa-pencil d-block d-md-none"></i>
                    </button>
                    <button type="button" class="btn btn-danger p-2 px-3">
                        <span class="d-none d-md-block">Borrar</span>
                        <i class="fa-solid fa-trash d-block d-md-none"></i>
                    </button>
                </div>
            @endcan
        </div>
        <div class="card-body d-flex flex-row justify-content-around gap-2">
            <div class="col-4 d-flex flex-column align-items-center justify-content-be m-0 me-4 p-3 gap-3">
                <img class="img-fluid" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto Default">
                <input type="file" id="profpic" class="d-none">
                <input type="button" class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
            </div>
            <div class="col-md-7 col-6">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" disabled class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" disabled class="form-control" id="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" disabled class="form-control" id="dni">
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" disabled class="form-control" id="telefono">
                    </div>
                    @can('is_coordinador')
                        <div class="d-flex justify-content-end col-12">
                            <button type="submit" disabled class="btn btn-success p-2 px-3">Confirmar</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
</div>
