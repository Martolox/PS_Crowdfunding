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
							markNotificationAsRead(id);
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

	function markNotificationAsRead(id) {
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

	function loadComments() {
		fetch('<?= base_url('comments/getUnreadComments'); ?>')
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

					updateCommentsCounter(count);				
					commentsDropdown.innerHTML = updateCommentsDropdown(count, comments);

					 // Agregar evento a cada comentario para abrir el modal y marcar como leída
					document.querySelectorAll('.comment-item').forEach(item => {
						item.addEventListener('click', function (event) {
							event.preventDefault();
							const id = this.getAttribute('data-id');
							const description = this.getAttribute('data-description');
							const date = new Date(this.getAttribute('data-date')).toLocaleString();

							document.getElementById('modalCommentDescription').textContent = description;
							document.getElementById('modalCommentDate').textContent = date;
							document.getElementById('commentModal').style.display = 'block';

							// Marcar como leída
							markCommentAsRead(id);
						});
					});

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

	function updateCommentsCounter(count) {
		if (count > 0) {
			commentsCount.textContent = count;
			commentsCount.style.display = 'inline';
		} else commentsCount.style.display = 'none';
	}

	function updateCommentsDropdown(count, comments) {
		let html = '';
		if (count > 0) {
			html += `<span class="dropdown-item dropdown-header">${count} comentarios</span>`;
			html += `<div class="dropdown-divider"></div>`;

			comments.forEach(comm => {
				html += `		
					<a href="#" class="dropdown-item comment-item" data-id="${comm.id}" data-description="${comm.comment}" data-date="${comm.comment_date}">
						<i class="fas fa-comments me-2"></i>
						<span class="comment-text">${comm.comment}</span>
						<span class="float-end text-muted fs-7">
							${new Date(comm.comment_date).toLocaleString()}
						</span>
					</a>
					<div class="dropdown-divider"></div>
				`;
			});

			html += `
				<a href="<?= base_url('myComments'); ?>" class="dropdown-item dropdown-footer">
					Ver todos los comentarios
				</a>
			`;
		} else html += `<span class="dropdown-item dropdown-header">No tienes comentarios nuevos.</span>`;

		return html;
	}

	function markCommentAsRead(id) {
		fetch(`<?= base_url('comments/markCommentAsRead/'); ?>${id}`, {
			method: 'POST'
		}).then(response => response.json())
		.then(data => {
			if (data.status === 'success') {
				loadComments();
			}
		})
		.catch(error => console.error('Error al marcar comentario como leído:', error));
	}

	loadComments();
	loadNotifications();
	// Intervalo para recargar las notificaciones cada 30 segundos
	// setInterval(loadNotifications, 30000);
});

</script>