<div class="container d-flex align-items-center justify-content-center flex-row">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header d-flex align-items-center justify-content-between px-4">
            <span class="text-primary fw-bold fs-5">Historico alumno</span>
            <div class="d-flex gap-3">
                <button type="button" class="btn btn-primary p-2 px-3">
                    <span class="d-none d-md-block">Editar</span>
                    <i class="fa-solid fa-pencil d-block d-md-none"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="container ">
                <form class="form-historico">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label class="fw-bold text-primary">Alumno</label>
                            <input type="text"  class="form-control" id="nombre">
                        </div>
                        <div class="col-6">
                            <label class="fw-bold text-primary">Grado</label>
                            <input type="text" class="form-control" id="grado">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label class="fw-bold text-primary">Curso</label>
                            <input type="text"  class="form-control" id="curso">
                        </div>
                        <div class="col-6">
                            <label class="fw-bold text-primary">Facilitador centro</label>
                            <input type="text" class="form-control" id="facilitador_curso">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="fw-bold text-primary">Facilitador empresa</label>
                            <input type="text" class="form-control" id="facilitador_empresa">
                        </div>
                        <div class="d-flex align-items-end justify-content-end col-6">
                            <button type="submit" class="btn btn-success p-2 px-3">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
