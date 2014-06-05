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


            var doughnutData = [
                {
                    value: progreso_one,
                    color: "#46BFBD",
                    label: 'Sleep',
                    labelColor: 'blue',
                    labelFontSize: '10',
                    labelAlign: 'left'
                },
                {
                    value: eval(100 - progreso_one),
                    color: "#F7464A",
                    label: 'Sleep',
                    labelColor: 'blue',
                    labelFontSize: '10',
                    labelAlign: 'left',

                }

            ];
            var doughnutTwo = [
                {
                    value: progreso_two,
                    color: "#46BFBD",
                    label: 'Sleep',
                    labelColor: 'black',
                    labelFontSize: '16'
                },
                {
                    value: eval(100 - progreso_two),
                    color: "#F7464A",
                    label: 'Sleep'
                }

            ];
            var doughnutTree = [
                {
                    value: progreso_tree,
                    color: "#46BFBD",
                    label: 'Sleep',
                },
                {
                    value: eval(100 - progreso_tree),
                    color: "#F7464A",
                    label: 'Sleep'
                }

            ];
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

            var myLine = new Chart(document.getElementById("doughnut").getContext("2d")).Pie(doughnutData, {labelAlign: 'right'});
            var myLine = new Chart(document.getElementById("doughnut_two").getContext("2d")).Pie(doughnutTwo, DoughnutOptions);
            var myLine = new Chart(document.getElementById("doughnut_tree").getContext("2d")).Pie(doughnutTree, DoughnutOptions);
        }
    });
}

