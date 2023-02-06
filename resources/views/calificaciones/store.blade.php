<div class="container d-flex align-items-center justify-content-center flex-row">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header text-primary fs-3">Calificaciones de {{$persona->name}}</div>
        <form>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <td>Actitud y disposición para el trabajo</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota1">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Puntualidad</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota2">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Responsabilidad</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota3">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Capacidad de resolución de problemas</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota4">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Calidad en el trabajo</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota5">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Implicación e integración en el equipo</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota6">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Toma de decisiones</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota7">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                  <tr>
                        <td>Capacidad de comunicación oral y escrita</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota8">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                  <tr>
                        <td>Capacidad de planificación y organización.</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota9">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                  <tr>
                        <td>Capacidad de aprendizaje y asimilación</td>
                        <td>
                            <select class="form-select form-select-sm w-auto" name="nota10">
                                <option value="insuficiente">Insuficiente</option>
                                <option value="suficiente">Suficiente</option>
                                <option value="suficiente">Bien</option>
                                <option value="suficiente">Notable</option>
                                <option value="suficiente">Sobresaliente</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <input class="btn btn-primary" type="submit" value="Publicar">
            </div>
        </form>
    </div>
</div>
