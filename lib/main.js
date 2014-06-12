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
    $('#myModo').modal();


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
        $("#data").datepicker({dateFormat: 'dd-mm-yy'});
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
            if (data.estatus) {
                alert(data.mensaje);
                location.reload();
            } else {
                alert(data.mensaje);
            }
        }
    });
}


jQuery(function($) {
    $('.easy-pie-chart.percentage').each(function() {
        var $box = $(this).closest('.infobox');
        var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(0,255,255,0.95)');
        var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
        var size = parseInt($(this).data('size')) || 50;
        $(this).easyPieChart({
            barColor: barColor,
            trackColor: trackColor,
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: parseInt(size / 10),
            animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
            size: size
        });
    })

    var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
    var data = [
        {label: "social networks", data: 38.7, color: "#68BC31"},
        {label: "search engines", data: 24.5, color: "#2091CF"},
        {label: "ad campaigns", data: 8.2, color: "#AF4E96"},
        {label: "direct traffic", data: 18.6, color: "#DA5430"},
        {label: "other", data: 10, color: "#FEE074"}
    ]
    function drawPieChart(placeholder, data, position) {
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    tilt: 0.8,
                    highlight: {
                        opacity: 0.25
                    },
                    stroke: {
                        color: '#fff',
                        width: 2
                    },
                    startAngle: 2
                }
            },
            legend: {
                show: true,
                position: position || "ne",
                labelBoxBorderColor: null,
                margin: [-30, 15]
            }
            ,
            grid: {
                hoverable: true,
                clickable: true
            }
        })
    }
    drawPieChart(placeholder, data);

    /**
     we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
     so that's not needed actually.
     */
    placeholder.data('chart', data);
    placeholder.data('draw', drawPieChart);


    //pie chart tooltip example
    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
    var previousPoint = null;

    placeholder.on('plothover', function(event, pos, item) {
        if (item) {
            if (previousPoint != item.seriesIndex) {
                previousPoint = item.seriesIndex;
                var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                $tooltip.show().children(0).text(tip);
            }
            $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
        } else {
            $tooltip.hide();
            previousPoint = null;
        }

    });






    var d1 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.5) {
        d1.push([i, Math.sin(i)]);
    }

    var d2 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.5) {
        d2.push([i, Math.cos(i)]);
    }

    var d3 = [];
    for (var i = 0; i < Math.PI * 2; i += 0.2) {
        d3.push([i, Math.tan(i)]);
    }


    var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
    $.plot("#sales-charts", [
        {label: "Domains", data: d1},
        {label: "Hosting", data: d2},
        {label: "Services", data: d3}
    ], {
        hoverable: true,
        shadowSize: 0,
        series: {
            lines: {show: true},
            points: {show: true}
        },
        xaxis: {
            tickLength: 0
        },
        yaxis: {
            ticks: 10,
            min: -2,
            max: 2,
            tickDecimals: 3
        },
        grid: {
            backgroundColor: {colors: ["#fff", "#fff"]},
            borderWidth: 1,
            borderColor: '#555'
        }
    });

})
		