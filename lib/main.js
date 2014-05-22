/* 
 * Creado Por Ing. Angel Gonzalez
 * Fecha : 28/04/2014
 */
var map;
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

    map = new GMaps({
        div: '#map',
        lat: 10.203313,
        lng: -68.008005,
        zoom:17,
       
    });
    
     map.addMarker({
        lat: 10.203313,
        lng: -68.008005,
        title: 'Address',      
        infoWindow: {
            content: '<h5 class="title">Washington English Institute</h5><p><span class="region">Av. Bolivar Norte</span><br><span class="postal-code">Postcode</span><br><span class="country-name">Valencia, Venezuela</span></p>'
        }
        
    });

    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        alert("asd");
    });


});

