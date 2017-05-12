{block 'css'}
<!-- iCheck for checkboxes and radio inputs -->
<link href="<?=base_url('public/sources/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('public/sources/plugins/iCheck/futurico/futurico.css')?>" rel="stylesheet" type="text/css" />

    <style type="text/css" media="screen">
        .btn-block-download{
            width: 100px;
            display: inline-block;
            float: right;
            margin:0px 3px 0px 3px !important;
            text-decoration: none !important;
        }
        body{
            background: url(public/app/img/bg3.jpg) no-repeat;
            background-size: 100% 100%;
            background-position: 50% 50%;
        }
    </style>
{/block}

{block 'contenido'}
 <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div id="frmSolicitarFactura" style="margin:7% auto">


                    <div class="box box-primary" style="    background: rgba(51, 27, 27, 0.54);">
                        <div class="box-header">
                         <section class="content-header">
                      <h1 style="color:white">
                        Documentos Factura Electrónica CHASA
                        <small style="color:white">[Consulta]</small>
                      </h1>
                    </section>
                          <!-- <h3 class="box-title">Quick Example</h3> -->
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="<?=base_url('home/consultar')?>" method="post" id="frmConsulta" style="color:white">
                          <div class="box-body">
                         <!--  <div class="row">
                            <div class="col-sm-6"> -->

                              <div class="form-group">
                                <label for="selHotel">Hotel</label>

                                <select class="form-control" name="selHotel" id="selHotel" placeholder="Seleccionar Hotel">
                                  <?php foreach ($lst_hoteles as $key => $value): ?>
                                      <option value="<?=$value->hot_id?>"><?=$value->hot_nombre?></option>

                                  <?php endforeach ?>
                                </select>
                              </div>
                       <!--      </div>
                            <div class="col-sm-6"> -->

                              <div class="form-group">
                                <label>Tipo de Documento</label>

                                <select class="form-control" name="selTipoDoc" id="selTipoDoc">
                                  <option value="-1">-- Seleccione --</option>
                                  <option value="01">Factura</option>
                                  <option value="03">Boleta</option>
                                  <!-- <option value="07">Nota Credito</option> -->
                                  <option value="08">Nota Debito</option>
                                </select>
                              </div>
                         <!--    </div>
                          </div> -->
                      <!--       <div class="row">
                              <div class="col-sm-6"> -->

                                <div class="form-group">
                                  <label for="txtNumDoc">Folio del Documento </label>
                                  <input type="text" class="form-control" id="txtNumDoc" name="txtNumDoc" placeholder="Serie-Correlativo" style="    text-transform: uppercase;">
                                </div>
                           <!--    </div>
                              <div class="col-sm-6"> -->
                                <div class="form-group">
                                  <label for="txtFecha">Fecha Emisión </label>

                                  <input id="txtFecha" name="txtFecha" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd/mm/yyyy" />
                               <!--    <input type="text" class="form-control" name="txtFecha" id="txtFecha" placeholder="DD-MM-AAAA"> -->
                                </div>
                          <!--     </div>

                            </div> -->
                            <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtMonto">Monto Total </label>
                                    <input type="text" class="form-control " name="txtMonto" id="txtMonto" placeholder="Cantidad dinero">
                                  </div>
                                </div>
                            <div class="col-sm-6">

                            <div class="form-group">
                              <label for="txt_tipo_moneda">Moneda</label>
                              <div>
                                   <label>
                                                  <input type="radio" name="txt_tipo_moneda" value="1" class="minimal rad-moneda" checked/>&nbsp;
                                                  SOLES&nbsp;
                                                </label>
                                                <label>
                                                  <input type="radio" name="txt_tipo_moneda" value="2" class="minimal rad-moneda"/>&nbsp;
                                                  DÓLARES&nbsp;
                                                </label>
                              </div>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-6">
                                   <div class="form-group">
                                    <?=$this->recaptcha->getWidget();?>
                                  </div>
                              </div>
                            </div>


                          </div><!-- /.box-body -->


                          <div class="box-footer" style="background: rgba(0, 0, 0, 0);">
                            <button type="submit" class="btn btn-primary">Ver Documento</button>
                          </div>
                        </form>
                    </div><!-- /.box -->

                  <div class="callout callout-info resultados hidden">
                    <h4>Documento Encontrado</h4>
                    <div class="download">
                        <p style="padding-bottom:15px">Puede descargar en los siguientes formatos

                        <a href=""  class="btn btn-block btn-social  btn-block-download" id="btnDowXml" style="background-color: rgb(8, 116, 59) !important;">
                            <img src="<?php echo base_url('public/sources/img/excel.png') ?>" alt=""> XML
                        </a>
                        <a href=""  class="btn btn-block btn-social  btn-block-download" id="btnDowPdf" style="background-color: rgb(234, 76, 58) !important">
                            <img src="<?php echo base_url('public/sources/img/pdf.png') ?>" alt=""> PDF
                        </a>

                        </p>
                    </div>


                  </div>
                  <div class="callout callout-info resultados-null hidden">
                    <h4>Sin resultados</h4>
                  </div>
                </div>
            </div>
        </div>
{/block}

{block 'script'}
<script type="text/javascript">
var app = {};
app.correlativos = <?=isset($correlativo) ? $correlativo : '[]'?>;
</script>
<?= $this->recaptcha->getScriptTag(); ?>
<script src="<?=base_url('public/app//js/app.js')?>" type="text/javascript"></script>
<!-- InputMask -->
<script src="<?=base_url('public/sources/plugins/input-mask/jquery.inputmask.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/sources/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/sources/plugins/input-mask/jquery.inputmask.extensions.js')?>" type="text/javascript"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=base_url('public/sources/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/app/js/'); ?>consultar.js" type="text/javascript"></script>
{/block}