$(document).ready(function() {
	var pageTitle = document.title; //HTML page title
	var pageUrl = location.href; //Location of the page

	
	//user hovers on the share button	
	$('.chat_content li').hover(function() {
		var hoverEl = $(this); //get element
		
		//browsers with width > 699 get button slide effect
		if($(window).width() > 199) { 
			if (hoverEl.hasClass('visible')){
				hoverEl.animate({"margin-left":"-170px"}, "fast").removeClass('visible');
			} else {
				hoverEl.animate({"margin-left":"0px"}, "fast").addClass('visible');
			}
		}
	});
		
	//user clicks on a share button
	$('.button-wrap').click(function(event) {
                        
			var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
			switch (shareName) //switch to different links based on different social name
			{
				case 'home':
					var openLink = 'inicio.php?lugar=inicio';
					break;
				case 'tem':
					var openLink = 'inicio.php?lugar=lecciones&lecc=#';
					break;
				case 'transito':
					var openLink = 'http://www.alcaldiadevalencia.gob.ve';
					break;
				case 'policia':
					var openLink = 'http://www.alcaldiadevalencia.gob.ve';
					break;
				case 'delicious':
					var openLink = 'http://www.alcaldiadevalencia.gob.ve';
					break;
				case 'google':
					var openLink = 'http://www.alcaldiadevalencia.gob.ve';
					break;
				case 'ima':
					var openLink = 'http://www.alcaldiadevalencia.gob.ve';
					break;
			}
		
		//Parameters for the Popup window
		/*winWidth 	= 650;	
		winHeight	= 450;
		winLeft   	= ($(window).width()  - winWidth)  / 2,
		winTop    	= ($(window).height() - winHeight) / 2,	
		winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
		*/
		//open Popup window and redirect user to share website.
		window.open(openLink,'Compartit este Enlace',winOptions);
		return false;
	});
});