

window.onload = fnLoad;
var filtrosDatatable = [];
function fnLoad(){

    $("#txt_fecha_emision").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    app_hotel.tbl_listar = $('#tbl_docs').on('click', '.btn-acciones', fnClickAcciones);
    app_hotel.frmReg = $('#frm_docs').on('submit', fnRegistrar);
    app_hotel.btnGuardar = $('#btnGuardar');
    app_hotel.txt_correlativo = $('#txt_correlativo');
    app_hotel.filesup = $('.filesup').on('change', fnChangeFileUp);
    app_hotel.sel_tipo = $('#sel_tipo').on('change', fnChangeSelTipo);
    app_hotel.sel_hotel = $('#sel_hotel').on('change', fnChangeSelHotel);
    app_hotel.sel_hotel_filter = $('#sel_hotel_filter').on('change', fnChangeSelHotelFilter);
    app_hotel.btnCancelar = $('#btnCancelar').on('click', fnCancelar);
    app_hotel.eliminarFile = $('.eliminar-file').on('click', fnEliminarFile);
    app_hotel.title_registro = $('#title_registro');
    var lgg = lenguajeTable;
    lgg.search = 'Buscar : ';
    lgg.searchPlaceholder = 'Hotel';
    app_hotel.dtl =  app_hotel.tbl_listar.DataTable({
        language : lenguajeTable,
        processing : false,
        serverSide : true,
        ajax : {
            url : base_url() + 'documentos/datatable',
            type : 'post',
            error : fnFailAjax,
            data : function(d){
                console.log(d);
                d.filters = filtrosDatatable;
            },
        },
        dom : 'tp',
        columns : [
            {data : 'doc_correlativo'},
            {data : 'doc_tipo', render : function(d, t, r){
                switch(+d){
                    case 1:
                        return '<h4><span class="label label-default">FAC</span></h4>';
                        break;
                    case 3:
                        return '<h4><span class="label label-default">BOL</span></h4>';
                        break;
                    case 7:
                        return '<h4><span class="label label-default">NCR</span></h4>';
                        break;
                    case 8:
                        return '<h4><span class="label label-default">NDE</span></h4>';
                        break;
                }
            }},
            {data : 'doc_fecha_format'},
            {data : 'doc_tipo_monto', render : function(d, t, r){
                switch(+d){
                    case 1: return 'PEN';break;
                    case 2: return 'USD';break;
                    default: return '---'; break;
                }
            }},
            {data : 'doc_monto_total'},
            {data : 'doc_ruta_formatpdf', render : function(d, t, r){
                return '<a href="'+ base_url('docs/' + r.doc_ruta) +'" target="_blank">'+ d +'</a>';
            }},
            {data : 'doc_ruta_formatxml', render : function(d, t, r){
                return '<a href="'+ base_url('home/documento/xml/' + r.doc_id) +'">'+ d +'</a>';
            }},
            {data : 'doc_id', render : function(d, t, r){
                return `<a class="btn btn-appdos btn-acciones" data-accion="editar" data-objid="${d}">
                    <i class="fa fa-edit "></i></a>
                    <a class="btn btn-appdos btn-acciones" data-accion="eliminar" data-objid="${d}">
                    <i class="fa fa-trash-o "></i></a>`;
            }}
        ],
        columnDefs : [
            {
                targets : [7],
                orderable : false,
                width : '82px',
                className : 'centrar-vertical'
            },
            {
                targets : [0], width : '75px'
            },
            {
                targets : [1], width : '50px'
            },
            {
                targets : [2], width : '75px'
            },
            {
                targets : [3,4], width : '35px'
            },
            {
                targets : [5,6], orderable : false, className : 'centrar-vertical'
            },
            {
                targets : [0,1,2,3,4], className : 'centrar-texto'
            }
        ]

    });
}
function fnEliminarFile(e){
    let idname = '', idinput = '';
    switch(this.dataset.target){
        case 'pdf':
            idname = 'namefilepdf';
            idinput = 'filepdf';
            break;
        case 'xml':
            idname = 'namefilexml';
            idinput = 'filexml';
            break;
    }
    document.getElementById(idname).value = '';
    document.getElementById(idinput).value = null;
}
function fnChangeFileUp(e){
    let idname = '';
    switch(this.name){
        case 'filepdf':
            idname = 'namefilepdf';
            break;
        case 'filexml':
            idname = 'namefilexml';
            break;
    }
    $('#' + idname).val(this.files[0].name);
}
function get_correlativo(tipo){
    for (var i = 0; i < app_hotel.correlativos.length; i++) {
        if(app_hotel.correlativos[i].tipo == tipo)
            return app_hotel.correlativos[i];
    };
    return false;
}
function fnChangeSelTipo (e){
    if(+this.value != -1){
        if(app_hotel.btnGuardar.prop('disabled')) app_hotel.btnGuardar.prop('disabled', false);
        let temp = get_correlativo(+this.value);
        if(temp){
            app_hotel.txt_correlativo.val(temp.value+'-00000000');
        }
        // $.getJSON(base_url() + 'gestion/getcorrelativo', {id_hotel : this.value}, function(json, textStatus) {
        //     console.log(json);
        // }).fail(fnFailAjax);
    }else{
        if(!app_hotel.btnGuardar.prop('disabled')) app_hotel.btnGuardar.prop('disabled', true);
        app_hotel.txt_correlativo.val('');
    }
}
function fnChangeSelHotel(e){
        $.getJSON(base_url() + 'gestion/getcorrelativo', {id_hotel : this.value}, function(json, textStatus) {
            if(json.resultado){
                app_hotel.correlativos = json.objRes;
                app_hotel.sel_tipo.val('-1').trigger('change');
            }
        }).fail(fnFailAjax);


}
function fnRegistrar(e){
    e.preventDefault();
    let formData = new FormData(app_hotel.frmReg.get(0));
    $.ajax({
        url: this.action,
        type: 'post',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false
    })
    .done(function(data) {
        console.log(data);
        app_hotel.dtl.page(app_hotel.dtl.page()).draw('page');
        // app_hotel.frmReg.get(0).reset();
        app_hotel.btnGuardar.prop('disabled', true);
        if(app_hotel.frmReg.hasClass('editando')){
            app_hotel.frmReg.removeClass('editando');
            fnCancelar();
        }
    })
    .fail(fnFailAjax)
    .always(function() {
        console.log("complete");
    });

    // $.post(this.action, formData, function(data, textStatus, xhr) {
    //     if(data.resultado){
            // app_hotel.dtl.draw();
            // if(app_hotel.frmReg.hasClass('editando')){
            //     app_hotel.frmReg.removeClass('editando');
            //     fnCancelar();
            // }
    //     }
    // },'json').fail(fnFailAjax);
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
{
    $.getJSON(base_url() + 'documentos/eliminar', {id_doc: id}, function(json, textStatus) {
        if(json.resultado)
            app_hotel.dtl.page(app_hotel.dtl.page()).draw('page');
    }).fail(fnFailAjax);
}

function fnEditar(id_doc){
    let frm = app_hotel.frmReg.get(0);
    let ele = frm.elements;
    $.getJSON(base_url() + 'documentos/getdoc/' + id_doc, {}, function(json, textStatus) {
        if(json.resultado){
            ele.txt_id.value = json.objRes.doc_id;
            $(ele.sel_tipo).val(json.objRes.doc_tipo).trigger('change');
            ele.txt_correlativo.value = json.objRes.doc_correlativo;
            ele.txt_fecha_emision.value = json.objRes.doc_fecha_format;
            $('.rad-moneda').each(function(e,v){
                if(+v.value == +json.objRes.doc_tipo_monto)
                    $(v).iCheck('check');
            })
            ele.txt_monto.value = json.objRes.doc_monto_total;

            app_hotel.frmReg.addClass('editando');
            frm.action = base_url() + 'documentos/actualizar';
            app_hotel.title_registro.text('Editar Hotel');
            app_hotel.btnGuardar.text('Actualizar');
            if(app_hotel.btnCancelar.hasClass('hidden')) app_hotel.btnCancelar.removeClass('hidden');

        }
    });

}
function fnCancelar(){
    app_hotel.frmReg.prop('action', base_url() + 'documentos/registrar');
    app_hotel.frmReg.get(0).reset();
    app_hotel.title_registro.text('Registrar Documentoo');
    app_hotel.btnGuardar.text('Registrar');
    if(!app_hotel.btnCancelar.hasClass('hidden')) app_hotel.btnCancelar.addClass('hidden');
}
function fnChangeSelHotelFilter(e){
    e.preventDefault();
    filtrosDatatable = [];
    if((+this.value) != -1){
        filtrosDatatable.push({
                column : 'hot_id_hotel',
                filter : this.value});
    }
    app_hotel.dtl.draw();
}