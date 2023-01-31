<div class="container d-flex align-items-center justify-content-center flex-row">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header text-primary fs-3">Calificaciones de {{$persona->name}}</div>
        <form>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <td>Esfuerzo y regularidad</td>
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
                        <td>Orden, estructura y presentación</td>
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
                        <td>Contenido</td>
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
                        <td>Terminología y notación</td>
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
                        <td>Relaciona conceptos</td>
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
                        <td>Reflexión sobre el aprendizaje</td>
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
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <input class="btn btn-primary" type="submit" value="Publicar">
            </div>
        </form>
    </div>
</div>
