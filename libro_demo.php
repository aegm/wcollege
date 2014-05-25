<?php
session_start();
?>
<!doctype html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="JS/Plugins/turn/js/turn.min.js"></script>

<style type="text/css">
body{
	background:#ccc;
}
#magazine{
	width:1152px;
	height:752px;
}
#magazine .turn-page{
	background-color:#ccc;
	background-size:100% 100%;
}
</style>
</head>
<body>


<div id="magazine">
	<div style="background-image:url(images/libros/infantil_one/LibroPrmaria01.png);"></div>
	<div style="background-image:url(images/libros/infantil_one/LibroPrmaria012.png);"></div>
        <div style="background-image:url(images/libros/infantil_one/LibroPrmaria013.png);"></div>
        <div style="background-image:url(images/libros/infantil_one/LibroPrmaria014.png);"></div>
</div>


<script type="text/javascript">

	$(window).ready(function() {
            $('#magazine').turn({
                display: 'double',
                width: 1300,
		height: 681,
		autoCenter: true,   
                acceleration: true,
                gradients: !$.isTouch,
                elevation:50,
                when: {
                        turned: function(e, page) {
                                /*console.log('Current view: ', $(this).turn('view'));*/
                        }
                      }
                });
	});
	
	
	$(window).bind('keydown', function(e){
		
		if (e.keyCode==37)
			$('#magazine').turn('previous');
		else if (e.keyCode==39)
			$('#magazine').turn('next');
			
	});

</script>

</body>
</html>