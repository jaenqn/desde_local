{block 'css'}
<!-- DATA TABLES -->
<link href="<?=base_url('public/sources/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<style type="text/css" media="screen">
    label.label-left{
        text-align : left !important;
    }
</style>
{/block}
{block 'contenido'}
<div class="row">
    <div class="col-sm-6">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de Hoteles</h3>
          <!--     <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <div class="box-body">

              <table id="tbl_hoteles" class="table table-bordered table-hover">

                  <thead>
                      <tr>
                          <th>Nro</th>
                          <th>Hotel</th>
                          <th>RUC</th>
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>


                  </tbody>
              </table>
            </div><!-- /.box-body -->

          </div>
    </div>
    <div class="col-sm-6">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" id="title_registro">Registrar Hotel</h3>
          <!--     <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <div class="box-body">
                <fieldset>
                    <legend>Datos Hotel</legend>

                    <form role="form" id="frm_hotel" class="form-horizontal" action="<?=base_url('gestion/registrar_hotel')?>">
                      <div class="box-body">
                        <div class="form-group">
                        <input type="hidden" name="txt_id" value="">
                            <label for="txt_hotel" class="col-sm-3 control-label label-left">Hotel</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="txt_hotel" name="txt_hotel" placeholder="Escriba nombre de Hotel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_ruc" class="col-sm-3 control-label label-left">RUC</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="txt_ruc" name="txt_ruc" placeholder="Número de RUC">
                            </div>
                        </div>

                        <fieldset class="form-horizontal">
                            <legend>Correlativos</legend>
                            <!-- <form role="form" class="form-horizontal" id="frm_hotel_correlativos"> -->
                                <!-- <div class="box-body"> -->
                                    <div class="form-group">
                                        <label for="txt_fatcura" class="col-sm-3 control-label label-left">Factura</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="txt_fatcura" name="txt_fatcura" placeholder="Factura">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt_Boleta" class="col-sm-3 control-label label-left">Boleta</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="txt_Boleta" name="txt_Boleta" placeholder="Boleta">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt_notcre" class="col-sm-3 control-label label-left">Not. Crédito</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="txt_notcre" name="txt_notcre" placeholder="Cédito">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt_txtdeb" class="col-sm-3 control-label label-left">Not. Débito</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="txt_txtdeb" name="txt_txtdeb" placeholder="Débito">
                                        </div>
                                    </div>

                                <!-- </div> -->
                            <!-- </form> -->
                        </fieldset>

                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Registrar</button>
                        <button type="button" class="btn btn-danger hidden" id="btnCancelar">Cancelar</button>
                      </div>
                    </form>

                </fieldset>

            </div><!-- /.box-body -->

          </div>
    </div>
</div>
{/block}
{block 'script'}
 <!-- DATA TABES SCRIPT -->
<script src="<?=base_url('public/sources/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/sources/plugins/datatables/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url('public/views/gestion/ges_hoteles.js')?>"></script>
{/block}