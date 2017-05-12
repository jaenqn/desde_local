window.onload = fnLoad;
function fnLoad(){
    $("#txtFecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
     checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
    });
    app.frmConsultar =  $('#frmConsulta').on('submit', fnSubmit);
    app.txtNumDoc = $('#txtNumDoc').on('keyup', function(e){
        // this.value = this.value.toUpperCase();
    });
    app.selTipoDoc = $('#selTipoDoc').on('change', fnChangeSelTipo);
    app.selHotel = $('#selHotel').on('change', fnChangeSelHotel);
    app.txtMonto = $('#txtMonto').on('keypress', function(e){

        e.preventDefault();
        // this.value = this.value + 's';
        if(this.value != ''){

            if(!(e.keyCode == 46)){

                this.value += e.key;
                let g = sol_numeros_decimal(this.value);
                if(g == 0 )
                    this.value = '';
                else this.value = g;


            }else this.value += e.key;
        }else{
            this.value = e.key;
            let g = sol_numeros_decimal(this.value);
              if(g == 0 )
                    this.value = '';
        }
    })
}
function fnChangeSelHotel(e){
        $.getJSON(base_url() + 'gestion/getcorrelativo', {id_hotel : this.value}, function(json, textStatus) {
            if(json.resultado){
                app.correlativos = json.objRes;
                app.selTipoDoc.val('-1').trigger('change');
            }
        }).fail(fnFailAjax);


}
function fnSubmit(e){
    e.preventDefault();
    console.log(app.frmConsultar.serializeArray());
    $.post(
        app.frmConsultar.attr('action'),
        app.frmConsultar.serializeArray(),
        function(data, textStatus, xhr) {
            console.log(data);
            if(data.msg == 'success'){
                grecaptcha.reset();
                if($('.resultados').hasClass('hidden'))
                    $('.resultados').removeClass('hidden');
                if(!$('.resultados-null').hasClass('hidden'))
                    $('.resultados-null').addClass('hidden');
                $('#btnDowPdf').eq(0).prop('href', BASE_URL + 'home/documento/pdf/' + data.objData.doc_id);
                $('#btnDowXml').eq(0).prop('href', BASE_URL + 'home/documento/xml/' + data.objData.doc_id);
            }else if(data.msg == 'fail'){
                grecaptcha.reset();
                if($('.resultados-null').hasClass('hidden'))
                    $('.resultados-null').removeClass('hidden');
                if(!$('.resultados').hasClass('hidden'))
                    $('.resultados').addClass('hidden');
            }
    },'json').fail(fnFail);

}
function fnFail(e){
    console.log(e.responseText);
}

function get_correlativo(tipo){
    for (var i = 0; i < app.correlativos.length; i++) {
        if(app.correlativos[i].tipo == tipo)
            return app.correlativos[i];
    };
    return false;
}
function fnChangeSelTipo (e){
    if(+this.value != -1){
        let temp = get_correlativo(+this.value);
        if(temp){
            app.txtNumDoc.val(temp.value+'-00000000');
        }

    }else app.txtNumDoc.val('');

}