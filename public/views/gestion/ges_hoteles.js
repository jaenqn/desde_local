var app_hotel = {};

window.onload = fnLoad;
function fnLoad(){
    app_hotel.tbl_listar = $('#tbl_hoteles').on('click', '.btn-acciones', fnClickAcciones);
    app_hotel.frmReg = $('#frm_hotel').on('submit', fnRegistrar);
    app_hotel.btnGuardar = $('#btnGuardar');
    app_hotel.btnCancelar = $('#btnCancelar').on('click', fnCancelar);
    app_hotel.title_registro = $('#title_registro');
    var lgg = lenguajeTable;
    lgg.search = 'Buscar : ';
    lgg.searchPlaceholder = 'Hotel';
    app_hotel.dtl =  app_hotel.tbl_listar.DataTable({
        language : lenguajeTable,
        processing : false,
        serverSide : true,
        ajax : {
            url : base_url() + 'gestion/datatable_hoteles',
            type : 'post',
            error : fnFailAjax
        },
        dom : 'ftp',
        columns : [
            {data : 'hot_id'},
            {data : 'hot_nombre'},
            {data : 'hot_ruc'},
            {data : 'hot_id', render : function(d, t, r){
                return `<a class="btn btn-appdos btn-acciones" data-accion="editar" data-objid="${d}">
                    <i class="fa fa-edit "></i></a>
                    <a class="btn btn-appdos btn-acciones" data-accion="eliminar" data-objid="${d}">
                    <i class="fa fa-trash-o "></i></a>
                    <a href="${base_url() + 'gestion/configjson/' + d}" class="btn btn-appdos " data-accion="download" data-objid="${d}">
                    <i class="fa fa-download "></i></a>`;
            }}
        ],
        columnDefs : [
            {
                targets : [3],
                orderable : false
            },
            {
                targets : [0,1,2],
                className : 'show-details'
            }
        ]

    });
    app_hotel.tbl_listar.find('tbody').on('click', 'td.show-details', function(){
        var tr = $(this).closest('tr');
        var row = app_hotel.dtl.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    })
}
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Factura</td>'+
            '<td>&nbsp;&nbsp;:&nbsp;&nbsp;'+d.hot_cfactura+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Boleta</td>'+
            '<td>&nbsp;&nbsp;:&nbsp;&nbsp;'+d.hot_cboleta+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Nota Crédito</td>'+
            '<td>&nbsp;&nbsp;:&nbsp;&nbsp;'+d.hot_cnocre+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Nota Débito</td>'+
            '<td>&nbsp;&nbsp;:&nbsp;&nbsp;'+d.hot_cndeb+'</td>'+
        '</tr>'+
    '</table>';
}
function fnRegistrar(e){
    e.preventDefault();
    $.post(this.action, app_hotel.frmReg.serializeArray(), function(data, textStatus, xhr) {
        if(data.resultado){
            app_hotel.dtl.draw();
            if(app_hotel.frmReg.hasClass('editando')){
                app_hotel.frmReg.removeClass('editando');
                fnCancelar();
            }
        }
    },'json').fail(fnFailAjax);
}
function fnClickAcciones(e){
    switch(this.dataset.accion){
        case 'editar':
            fnEditar(this.dataset.objid);
            break;
        case 'eliminar':
            fnEliminar(this.dataset.objid);
            break;
    }
}

function fnEliminar(id){
    $.getJSON(base_url() + 'gestion/eliminar_hotel', {id_hotel: id}, function(json, textStatus) {
        if(json.resultado)
            app_hotel.dtl.page(app_hotel.dtl.page()).draw('page');
    }).fail(fnFailAjax);
}

function fnEditar(id_hotel){
    let frm = app_hotel.frmReg.get(0);
    let ele = frm.elements;
    $.getJSON(base_url() + 'gestion/gethotel/' + id_hotel, {}, function(json, textStatus) {
        if(json.resultado){
            ele.txt_id.value = json.objRes.hot_id;
            ele.txt_hotel.value = json.objRes.hot_nombre;
            ele.txt_ruc.value = json.objRes.hot_ruc;
            ele.txt_fatcura.value = json.objRes.hot_cfactura;
            ele.txt_Boleta.value = json.objRes.hot_cboleta;
            ele.txt_notcre.value = json.objRes.hot_cnocre;
            ele.txt_txtdeb.value = json.objRes.hot_cndeb;

            app_hotel.frmReg.addClass('editando');
            frm.action = base_url() + 'gestion/actualizar_hotel';
            app_hotel.title_registro.text('Editar Hotel');
            app_hotel.btnGuardar.text('Actualizar');
            if(app_hotel.btnCancelar.hasClass('hidden')) app_hotel.btnCancelar.removeClass('hidden');

        }
    });

}
function fnCancelar(){
    app_hotel.frmReg.prop('action', base_url() + 'gestion/registrar_hotel');
    app_hotel.frmReg.get(0).reset();
    app_hotel.title_registro.text('Registrar Hotel');
    app_hotel.btnGuardar.text('Registrar');
    if(!app_hotel.btnCancelar.hasClass('hidden')) app_hotel.btnCancelar.addClass('hidden');
}