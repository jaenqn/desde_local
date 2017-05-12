window.onload = fnLoad;
var app = {};
function fnLoad(){
    app.frmLogin = $('#frmaccesousuario').on('submit',fnLogin);

}

function fnLogin(e){
    e.preventDefault();
    $.post(app.frmLogin.attr('action'), app.frmLogin.serializeArray(), function(data, textStatus, xhr) {
        console.log(data);
        if(data.success){
            window.location = base_url('gestion/hoteles');
        }
    },'json').fail(function(e){console.log(e.responseText);});
}