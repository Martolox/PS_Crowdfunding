$(document).ready(function() {
	if ($('#menu .close').length === 0) { // Agrega el botón de cierre
		$('#menu').prepend('<a href="#" class="close"></a>');
	}

	$('li h3').click(function(e) {
		e.preventDefault();
		$('#menu').addClass('visible');
	});

	$('#menu .close').click(function(e) {
		e.preventDefault();
		$('#menu').removeClass('visible');
	});
});