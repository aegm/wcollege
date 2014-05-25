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

