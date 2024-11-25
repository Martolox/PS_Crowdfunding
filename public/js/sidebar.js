$(document).ready(function() {
		$('a[href="#sidebar"], .user-profile').click(function(e) {
			e.preventDefault();
			$('#sidebar').addClass('visible');
		});

		$('#sidebar .close').click(function(e) {
			e.preventDefault();
			$('#sidebar').removeClass('visible');
		});

		// Cerrar al hacer clic fuera del sidebar
		$(document).click(function(e) {
			if (!$(e.target).closest('#sidebar').length && 
				!$(e.target).closest('.user-profile').length) {
				$('#sidebar').removeClass('visible');
			}
		});

		// Prevenir que clicks dentro del sidebar lo cierren
		$('#sidebar').click(function(e) {
			e.stopPropagation();
		});
	});