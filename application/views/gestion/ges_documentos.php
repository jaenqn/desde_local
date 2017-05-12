{block 'css'}
<!-- DATA TABLES -->
<link href="<?=base_url('public/sources/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="<?=base_url('public/sources/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<style type="text/css" media="screen">
    label.label-left{
        text-align : left !important;
    }
    .centrar-texto{
      vertical-align: middle !important;
      text-align: center;
    }
    .centrar-vertical{
      vertical-align: middle !important;
    }
</style>
{/block}
{block 'contenido'}
<div class="row">

    <div class="col-sm-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" id="title_registro">Registrar Documento</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <!--   <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
                <!-- <fieldset>
                    <legend>Datos Hotel</legend> -->

                    <form enctype="multipart/form-data" role="form" id="frm_docs" class="" action="<?=base_url('documentos/registrar')?>">
                      <!-- <div class="box-body"> -->
                        <div class="col-sm-4">
                            <fieldset class="form-horizontal">
                                <!-- <legend>Correlativos</legend> -->
                                <!-- <form role="form" class="form-horizontal" id="frm_hotel_correlativos"> -->
                                    <!-- <div class="box-body"> -->
                                        <input type="hidden" name="txt_id" value="">

                                        <div class="form-group">
                                            <label for="sel_hotel" class="col-sm-3 control-label label-left">Hotel</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="sel_hotel" name="sel_hotel">
                                                    <?php foreach ($lst_hoteles as $key => $value): ?>
                                                        <option value="<?=$value->hot_id?>"><?=$value->hot_nombre?></option>
                                                    <?php endforeach ?>
                                                  </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sel_tipo" class="col-sm-3 control-label label-left">Tipo</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="sel_tipo" name="sel_tipo" placeholder="Seleccionar">
                                                  <option value="-1">-- Seleccione --</option>

                                                    <?php foreach (ent_documentos::lstTipos() as $key => $value): ?>
                                                        <option value="<?=+$value['value']?>"><?=$value['name']?></option>
                                                    <?php endforeach ?>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_correlativo" class="col-sm-3 control-label label-left">Correlativo</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txt_correlativo" name="txt_correlativo" placeholder="Correlativo" >
                                            </div>
                                        </div>

                                    <!-- </div> -->
                                <!-- </form> -->
                            </fieldset>
                        </div>
                        <div class="col-sm-4">

                            <fieldset class="form-horizontal">
                                <!-- <legend>Correlativos</legend> -->
                                <!-- <form role="form" class="form-horizontal" id="frm_hotel_correlativos"> -->
                                    <!-- <div class="box-body"> -->

                                        <div class="form-group">
                                            <label for="txt_fecha_emision" class="col-sm-3 control-label label-left">Fecha emisión</label>
                                            <div class="col-sm-9">
                                                <input id="txt_fecha_emision" name="txt_fecha_emision" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd/mm/yyyy" />

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_txtdeb" class="col-sm-3 control-label label-left">Moneda</label>
                                            <div class="col-sm-9">

                                                <label>
                                                  <input type="radio" name="txt_tipo_moneda" value="1" class="minimal rad-moneda" checked/>&nbsp;
                                                  PEN&nbsp;
                                                </label>
                                                <label>
                                                  <input type="radio" name="txt_tipo_moneda" value="2" class="minimal rad-moneda"/>&nbsp;
                                                  USD&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_monto" class="col-sm-3 control-label label-left">Monto</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txt_monto" name="txt_monto" placeholder="00.00">
                                            </div>
                                        </div>

                                    <!-- </div> -->
                                <!-- </form> -->
                            </fieldset>
                        </div>
                        <div class="col-sm-4">

                            <fieldset class="">
                                <!-- <legend>Correlativos</legend> -->
                                <!-- <form role="form" class="form-horizontal" id="frm_hotel_correlativos"> -->
                                    <!-- <div class="box-body"> -->

                                        <div class="form-group">
                                            <label for="txt_fatcura" class="control-label ">PDF</label>
                                            <div class="">

                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                      <label  class="btn btn-info" for="filepdf"><i class="fa fa-upload"></i></label>
                                                    </div><!-- /btn-group -->
                                                    <input type="text" class="form-control" id="namefilepdf">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-info btn-flat eliminar-file" data-target="pdf" type="button" style="border-radius: 0px 3px 3px 0px;"><i class="fa fa-trash"></i></button>
                                                    </span>

                                                <input id="filepdf" type="file" name="filepdf" data-url="" class="hidden filesup">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_txtdeb" class="control-label ">XML</label>
                                            <div class="">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                      <label for="filexml" class="btn btn-info"><i class="fa fa-upload"></i></label>
                                                    </div><!-- /btn-group -->
                                                    <input type="text" class="form-control" id="namefilexml">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-info btn-flat eliminar-file" data-target="xml" type="button" style="border-radius: 0px 3px 3px 0px;"><i class="fa fa-trash"></i></button>
                                                    </span>
                                                    <input id="filexml" type="file" name="filexml" data-url="" class="hidden filesup">
                                                </div>
                                            </div>
                                        </div>



                                    <!-- </div> -->
                                <!-- </form> -->
                            </fieldset>
                        </div>



                      <!-- </div> --><!-- /.box-body -->
                        <div class="clearfix"></div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnGuardar" disabled="">Registrar</button>
                        <button type="button" class="btn btn-danger hidden" id="btnCancelar">Cancelar</button>
                      </div>
                    </form>

                <!-- </fieldset> -->

            </div><!-- /.box-body -->

          </div>
    </div>
    <div class="col-sm-12">
         <div class="box">
            <div class="box-header with-border">

              <h3 class="box-title">Lista Documentos</h3>
          <!--     <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <div class="box-body">
            <div class="col-sm-4 form-horizontal">
              <div class="form-group">
                  <label for="sel_hotel_filter" class="col-sm-3 control-label label-left">Hotel</label>
                  <div class="col-sm-9">

                      <select class="form-control" id="sel_hotel_filter" name="sel_hotel_filter">
                      <option value="-1" selected="">Todos</option>
                          <?php foreach ($lst_hoteles as $key => $value): ?>
                              <option value="<?=$value->hot_id?>"><?=$value->hot_nombre?></option>
                          <?php endforeach ?>
                        </select>
                  </div>
              </div>
            </div>
              <div class="clearfix"></div>
              <hr>
              <table id="tbl_docs" class="table table-bordered table-hover">

                  <thead>
                      <tr>
                          <th>Correlativo</th>
                          <th>Tipo</th>
                          <th>F. Emisión</th>
                          <th>Moneda</th>
                          <th>Monto</th>
                          <th>PDF</th>
                          <th>XML</th>
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>


                  </tbody>
              </table>
            </div><!-- /.box-body -->

          </div>
    </div>
</div>
{/block}
{block 'script'}
<script type="text/javascript">
var app_hotel = {};
app_hotel.correlativos = <?=isset($correlativo) ? $correlativo : '[]'?>;
</script>
 <!-- DATA TABES SCRIPT -->
<script src="<?=base_url('public/sources/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/sources/plugins/datatables/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<!-- InputMask -->
<script src="<?=base_url('public/sources/plugins/input-mask/jquery.inputmask.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/sources/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/sources/plugins/input-mask/jquery.inputmask.extensions.js')?>" type="text/javascript"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=base_url('public/sources/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>

<script type="text/javascript" src="<?=base_url('public/views/gestion/ges_documentos.js')?>"></script>
{/block}