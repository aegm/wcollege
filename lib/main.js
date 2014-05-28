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
    $(function() {
        $("#data").datepicker({ dateFormat: 'dd-mm-yy' });
    });
    /*$('#where').click(function() {
        window.location.href = 'inicio.php?lugar=contacto';
        $('html, body').animate({scrollTop: $('.map-section').offset().top}, 'slow');
    });*/
})

function inscribir(id, nivel, pais) {
    $.ajax({
        type: "GET",
        cache: false,
        dataType: "json",
        url: "ajax/ajax.php",
        data: 'a=inscribir-curso&contrato=' + id + '&nivel=' + nivel + '&pais=' + pais,
        success: function(data) {
            if (data.estatus){
                alert(data.mensaje);
                location.reload();
            }else{
                alert(data.mensaje);
            }
        }
    });
}