<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header text-primary fw-bold fs-3">Crear facilitador del centro</div>
        <div class="card-body d-flex flex-row">
            <div class="col-3 d-flex flex-column align-items-center justify-content-be m-0 me-4 p-3 gap-3">
                <img class="img-fluid" src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="Foto Default">
                <input type="file" id="profpic" class="d-none">
                <input type="button" class="btn btn-primary" value="Cambiar foto" onclick="document.getElementById('profpic').click();">
            </div>
            <div class="col-8">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="empresa" class="form-label">Empresa</label>
                        <select class="form-select" aria-label="empresa">
                            <option>Empresa 1</option>
                            <option>Empresa 2</option>
                        </select>
                    </div>
                    @if($coordinador)
                        <div class="mb-4">
                            <label for="curso" class="form-label">Curso</label>
                            <select class="form-select" aria-label="curso">
                                <option>Curso 1</option>
                                <option>Curso 2</option>
                            </select>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end w-100">
                        <button type="submit" class="btn btn-success p-2 px-3">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
