/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var map;
$(document).ready(function() {
    $(function() {
        map = new GMaps({
            div: '#map',
            lat: 10.203313,
            lng: -68.008005,
            zoom: 17,
        });

        map.addMarker({
            lat: 10.203313,
            lng: -68.008005,
            title: 'Address',
            infoWindow: {
                content: '<h5 class="title">Washington English Institute</h5><p><span class="region">Av. Bolivar Norte</span><br><span class="postal-code">Postcode</span><br><span class="country-name">Valencia, Venezuela</span></p>'
            }

        });
    })
})