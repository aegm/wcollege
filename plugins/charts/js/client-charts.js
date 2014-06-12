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
    var progreso_one, progreso_two, progreso_tree;
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
                if (index == 'progreso_one')
                    progreso_one = value;
                if (index == 'progreso_two')
                    progreso_two = value;
                if (index == 'progreso_tree')
                    progreso_tree = value;

            });
            var data = {
                labels: ["Nivel 1", "Nivel 2", "Nivel 3"],
                datasets: [
                    {
                        fillColor: "rgba(16,117,189,0.5)",
                        strokeColor: "rgba(16,117,189,1)",
                        data: [progreso_one, progreso_two, progreso_tree]
                    },
                    {
                        fillColor: "rgba(224,24,34,0.5)",
                        strokeColor: "rgba(224,24,34,1)",
                        data: [eval(100 - progreso_one), eval(100 - progreso_two), eval(100 - progreso_tree)]
                    }
                ]
            }

            
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

            var myLine = new Chart(document.getElementById("doughnut").getContext("2d")).Bar(data);
          
        }
    });
}

