<!-- FOOTER -->

<section  id="footer"  class="surface1">
	<p>Except as otherwise noted, the content of this page is licensed under the Creative Commons Attribution 4.0 License, and code samples are licensed under the Apache 2.0 License. For details, see the SCV Developers Site Policies. Impulsa is a registered trademark of UNRN and/or its affiliates.<br><br>
	Last updated 2024-11-01 UTC.</p>
	
</section>

<script>
	document.addEventListener('DOMContentLoaded', function () {
	const notificationBell = document.getElementById('notificationBell');
	const notificationDropdown = document.getElementById('notificationDropdown');
	const notificationCount = document.getElementById('notificationCount');

	const commentsGlobe = document.getElementById('commentsGlobe');
	const commentsDropdown = document.getElementById('commentsDropdown');
	const commentsCount = document.getElementById('commentsCount');

	function loadNotifications() {
		fetch('<?= base_url('notifications/getUnreadNotifications'); ?>')
			.then(response => {
				if (!response.ok) {
					throw new Error('Error en la respuesta del servidor.');
				}
				return response.json();
			})
			.then(data => {
				if (data.status === 'success') {
					const notifications = data.data || [];
					const count = notifications.length;

					// Actualizar el contador de notificaciones
					if (count > 0) {
						notificationCount.textContent = count;
						notificationCount.style.display = 'inline';
					} else {
						notificationCount.style.display = 'none';
					}

					// Actualizar el contenido del dropdown
					let html = '';
					if (count > 0) {
						html += `<span class="dropdown-item dropdown-header">${count} Notificaciones</span>`;
						html += `<div class="dropdown-divider"></div>`;

						notifications.forEach(notification => {
							html += `
							
								<a href="#" class="dropdown-item notification-item" data-id="${notification.id_notifications}" data-description="${notification.description}" data-date="${notification.notification_date}">
                              		<i class="fas fa-bell me-2"></i>
									<span class="notification-text">${notification.description}</span>
									<span class="float-end text-muted fs-7">
										${new Date(notification.notification_date).toLocaleString()}
									</span>
								</a>
								<div class="dropdown-divider"></div>
							`;
						});

						html += `
							<a href="<?= base_url('myNotifications'); ?>" class="dropdown-item dropdown-footer">
								Ver todas las notificaciones
							</a>
						`;
					} else {
						html += `<span class="dropdown-item dropdown-header">No tienes notificaciones nuevas.</span>`;
					}

					notificationDropdown.innerHTML = html;

					 // Agregar evento a cada notificación para abrir el modal y marcar como leída
					document.querySelectorAll('.notification-item').forEach(item => {
						item.addEventListener('click', function (event) {
							event.preventDefault();
							const id = this.getAttribute('data-id');
							const description = this.getAttribute('data-description');
							const date = new Date(this.getAttribute('data-date')).toLocaleString();

							document.getElementById('modalNotificationDescription').textContent = description;
							document.getElementById('modalNotificationDate').textContent = date;
							document.getElementById('notificationModal').style.display = 'block';

							// Marcar como leída
							markAsRead(id);
						});
                	});

				} else {
					notificationCount.style.display = 'none';
					notificationDropdown.innerHTML = `
						<span class="dropdown-item dropdown-header">No tienes notificaciones nuevas.</span>
					`;
				}
			})
			.catch(error => {
				console.error('Error al cargar las notificaciones:', error);
				notificationCount.style.display = 'none';
				notificationDropdown.innerHTML = `
					<span class="dropdown-item dropdown-header">No hay notificaciones.</span>
				`;
			});
	}

	// Función para marcar una notificación como leída
	function markAsRead(id) {
		fetch(`<?= base_url('notifications/markAsRead/'); ?>${id}`, {
			method: 'POST'
		}).then(response => response.json())
		.then(data => {
			if (data.status === 'success') {
				loadNotifications(); // Recargar la lista para reflejar cambios
			}
		})
		.catch(error => console.error('Error al marcar como leída:', error));
	}

	// Función para cerrar el modal
	function closeModal() {
		document.getElementById('notificationModal').style.display = 'none';
	}

	function loadComments() {
		fetch('<?= base_url('comments/getUserComments'); ?>')
			.then(response => {
				if (!response.ok) {
					throw new Error('Error en la respuesta del servidor.');
				}
				return response.json();
			})
			.then(data => {
				if (data.status === 'success') {
					const comments = data.data || [];
					const count = comments.length;

					// Actualizar el contador de notificaciones
					if (count > 0) {
						commentsCount.textContent = count;
						commentsCount.style.display = 'inline';
					} else {
						commentsCount.style.display = 'none';
					}

					// Actualizar el contenido del dropdown
					let html = '';
					if (count > 0) {
						html += `<span class="dropdown-item dropdown-header">${count} Comentarios</span>`;
						html += `<div class="dropdown-divider"></div>`;

						comments.forEach(comment => {
							html += `
								<a href="#" class="dropdown-item">
									<i class="fas fa-bell me-2"></i>
									<span class="comment-text">${comment.description}</span>
									<span class="float-end text-muted fs-7">
										${new Date(comment.comment_date).toLocaleString()}
									</span>
								</a>
								<div class="dropdown-divider"></div>
							`;
						});

						html += `
							<a href="<?= base_url('myComments'); ?>" class="dropdown-item dropdown-footer">
								Ver todas los comentarios
							</a>
						`;
					} else {
						html += `<span class="dropdown-item dropdown-header">No tienes comentarios nuevos.</span>`;
					}

					commentsDropdown.innerHTML = html;
				} else {
					commentsCount.style.display = 'none';
					commentsDropdown.innerHTML = `
						<span class="dropdown-item dropdown-header">No tienes comentarios nuevos.</span>
					`;
				}
			})
			.catch(error => {
				console.error('Error al cargar los comentarios:', error);
				commentsCount.style.display = 'none';
				commentsDropdown.innerHTML = `
					<span class="dropdown-item dropdown-header">No hay comentarios.</span>
				`;
			});
	}

	loadComments();
	loadNotifications();
	// Intervalo para recargar las notificaciones cada 30 segundos
	// setInterval(loadNotifications, 30000);
});

</script>