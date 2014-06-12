/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('#buscar').click(function(event) {
        event.preventDefault();
        GetVentaList();

    });

});

function GetVentaList() {
    var data2 = "";
    var progreso_one, progreso_two, progreso_tree;
    $.ajax({
        type: "POST",
        url: "ajax/ajax.php",
        data: {a: 'grafico'},
        contentType: "application/x-www-form-urlencoded",
        dataType: "json",
        success: function(response) {
            /*if (response.estatus)
                var resultsArray = (typeof response.datos) == 'int' ? eval('(' + response.datos + ')') : response.datos;*/

            //alert(resultsArray.length);
            var data2 = new Array();
            // alert(data2);

            $.each(response.datos, function(index, value) {
                if (index == 'progreso_one')
                    progreso_one = value;
                if (index == 'progreso_two')
                    progreso_two = value;
                if (index == 'progreso_tree')
                    progreso_tree = value;

            });
            var radarChartData = {
                labels: ["Caramel", "Creamy", "Earthy", "Floral", "Fruity", "Spicy", "Sweet", "Woody"],
                datasets: [
                    {
                        fillColor: "rgba(228,154,7,0.5)",
                        strokeColor: "rgba(228,154,7,1)",
                        pointColor: "rgba(228,154,7,1)",
                        pointStrokeColor: "#fff",
                        data: ["10","20","30","15","62","12","20"]  //Where I want the data to be 
                    }

                ]


            };


            var DoughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animation: true,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                onAnimationComplete: null,
                labelFontFamily: "Arial",
                labelFontStyle: "normal",
                labelFontSize: 24,
                labelFontColor: "#666"
            }

            var myLine = new Chart(document.getElementById("doughnut").getContext("2d")).Line(radarChartData);

        }
    });

}
