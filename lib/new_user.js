/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#pais').change(function() {
        var pais = $('#pais').val();
        $.ajax({
            type: "GET",
            cache: false,
            dataType: "json",
            url: "ajax/ajax.php",
            data: 'a=listar-estado&pais=' + pais,
            success: function(data) {
                if (data.estatus)
                {
                    var lineas = '';
                    lineas += ('<option value="">Seleccione</option>');
                    $.each(data.datos, function(i, valor) {
                        lineas += '<option value="' + valor.id_estado + '">' + valor.nombre + '</option>';
                    });
                    $('#estado').html(lineas);
                }
            }
        });
    });

    $('#estado').change(function() {
        var ciudad = $('#estado').val();
        $.ajax({
            type: "GET",
            cache: false,
            dataType: "json",
            url: "ajax/ajax.php",
            data: 'a=listar-ciudades&estado=' + ciudad,
            success: function(data) {
                if (data.estatus)
                {
                    var lineas = '';
                    lineas += ('<option value="">Seleccione</option>');
                    $.each(data.datos, function(i, valor) {
                        lineas += '<option value="' + valor.id_ciudad + '">' + valor.nombre + '</option>';
                    });
                    $('#ciudades').html(lineas);
                }
            }
        });
    });
});
