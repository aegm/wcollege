/* 
 * Archivo Creado para generar el Objeto y los Graficos
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    GetCountryList();
});


function GetCountryList() {
    var data2 = "";
    var progreso, resto;
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: {a: 'grafico'},
        contentType: "application/x-www-form-urlencoded",
        dataType: "json",
        success: function(response) {
            if (response.estatus)
                var resultsArray = (typeof response.datos) == 'int' ? eval('(' + response.datos + ')') : response.datos;

            //alert(resultsArray.length);
            var data2 = new Array();
            // alert(data2);

            $.each(response.datos, function(index, value) {
                if (index == 'progreso')
                    progreso = value;
                else
                    resto = value;
            });


            var doughnutData = [
                {
                    value: progreso,
                    color: "#F7464A"
                },
                {
                    value: resto,
                    color: "#46BFBD"
                }

            ];

            var myLine = new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
        }
    });
}

