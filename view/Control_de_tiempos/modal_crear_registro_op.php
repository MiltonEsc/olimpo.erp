<div id="modal_crear_registro_op" class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px;">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="modal_control_tiempo_form_crear">
                    <div class="row">
                        <input type="hidden" id="modal_coti_id" name="modal_coti_id">
                        <div class="col-md-6">
                            <div class="form-group">
                            <h4 class="semibold text-center color-orange">ORDEN DE PRODUCCION</h4>
                                <input type="number" class="form-control" id="modal_num_op" name="modal_num_op" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <h4 class="semibold text-center">NUMERO DE HORAS</h4>
                                <input type="text" class="form-control" id="modal_nhoras" name="modal_nhoras" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <h4 class="semibold text-center">CT OPERACION</h4>
                            <select id="modal_ct_op" name="modal_ct_op" class="form-control form-control-lg" aria-label=".form-select-lg example">
                            <option value="CNC">CNC</option>
                            <option value="PNT">PNT</option>
                            <option value="ENS">ENS</option>
                            <option value="ENS2">ENS2</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6 modal_est_maquina" style="display: none;">
                            <div class="form-group">
                                <h4 class="semibold text-center">MAQUINA DE CNC</h4>
                                <select id="modal_maquina" name="modal_maquina" class="form-control form-control-lg" aria-label=".form-select-lg example">
                                    <option value="D">D: DOBLADORA</option>
                                    <option value="B">B: PUNZONADORA BOSHERT</option>
                                    <option value="C">C: CORTADORA</option>
                                    <option value="P">P: PLASMA</option>
                                    <option value="0">WT: NINGUNA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <h4 class="semibold text-center">NO CONFORME / NO ESTANDAR</h4>
                                <input type="text" class="form-control" id="modal_codigo_nc_ns" name="modal_codigo_nc_ns">
                            </div>
                        </div>
                    </div>
                    <!-- <input type="submit" name="submit" class="btn btn-success submitBtn" value="Insertar" />
                    <input type="hidden" id="id_departamento" name="id_departamento"> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>