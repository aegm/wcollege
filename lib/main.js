/* 
 * Creado Por Ing. Angel Gonzalez
 * Fecha : 28/04/2014
 */

$(document).ready(function() {
    /* ======= Flexslider ======= */
    $('.flexslider').flexslider({
        animation: "fade"
    });
    /* ======= Carousels ======= */
    $('#news-carousel').carousel({interval: false});
    $('.dropdown-menu').find('form').click(function(e) {
        e.stopPropagation();
    });



    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        alert("asd");
    });
    $('#myModal').modal();


});

$(function() {
    var texto = $('#blink');
    setInterval(function() {
        if (texto.attr('class') == 'chat') {
            texto.addClass('on')
        } else {
            texto.removeClass('on')
        }
    }, 500);
})

function inscribir(id, nivel, pais) {
    $.ajax({
        type: "GET",
        cache: false,
        dataType: "json",
        url: "ajax/ajax.php",
        data: 'a=inscribir-curso&contrato=' + id + '&nivel=' + nivel + '&pais=' + pais,
        success: function(data) {
            if (data.estatus)
                alert(data.mensaje);
            else
                alert(data.mensaje);
        }
    });
}