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
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: "{\"type\":" + "\"country\"" +
                "}",
        contentType: "application/x-www-form-urlencoded",
        dataType: "json",
        success: function(response) {

            var resultsArray = (typeof response) == 'string' ? eval('(' + response + ')') : response;
            var data2 = new Array();
            for (var i = 0; i < resultsArray.length; i++) {
                data2[i] = resultsArray[i].workgroup;
                var barChartData = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,1)",
                            data: [65, 59, 90, 81, 56, 55, 40, 80]
                        }
                    ]

                };
            }
            var myLine = new Chart(document.getElementById("doughnut").getContext("2d")).Line(barChartData);
        }
    });
}

