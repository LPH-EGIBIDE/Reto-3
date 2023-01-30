<div class="container d-flex align-items-center justify-content-center flex-row">
    <div class="card col-12 col-lg-8 p-0">
        <div class="card-header text-primary fs-3">Calificaciones de {{$persona->name}}</div>
        <form>
                <div class="card-body row">
                    <table class="table table-responsive">
                        <tr>
                            <td>Esfuerzo y regularidad</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Orden, estructura y presentación</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Contenido</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Terminología y notación</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Calidad en el trabajo</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Relaciona conceptos</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Reflexión sobre el aprendizaje</td>
                            <td>
                                <select class="form-select form-select-sm w-auto" name="evaluacion">
                                    <option value="insuficiente">Insuficiente</option>
                                    <option value="suficiente">Suficiente</option>
                                    <option value="bien">Bien</option>
                                    <option value="notable">Notable</option>
                                    <option value="sobresaliente">Sobresaliente</option>
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
