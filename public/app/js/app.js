var lenguajeTable = {
    search : "Buscar ",
    searchPlaceholder :'Buscar',
     paginate : {
        first :      "Primero",
        last :       "Último",
        next :       "Siguiente",
        previous :   "Anterior"
    },
    emptyTable :     "No existen datos disponibles en la tabla",
    info :           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
    infoEmpty :      "Mostrando 0 a 0 de 0 entradas",
    infoFiltered :   "(filtrado de _MAX_ total de entradas)",
    zeroRecords :    "No se encontraron registros coincidentes",
        };
function fnFailAjax(e){
    console.log(e);
    console.log(e.responseText);
}
$(document).ready(function() {
    let CURRENT_URL = window.location.href.split('?')[0];
    let SIDEBAR = $('.sidebar-menu');

    SIDEBAR.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('active');

 });

function sol_numeros_enteros(cadena){
    let temp = cadena.match(/[0-9]+/g);
    let c = '';
    if(temp !=null)
        c = temp.join('');
    return +c;
}
function sol_numeros_decimal(cadena){
    let temp = cadena.match(/^[0-9]+([.][0-9]+)?$/g);
    let c = '';
    if(temp !=null)
         c = temp.join('');
    return +c;
}

