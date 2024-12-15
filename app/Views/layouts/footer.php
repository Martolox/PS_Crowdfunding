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

    if (!notificationBell || !notificationDropdown || !notificationCount) {
        console.error("Elementos HTML de notificaciones no encontrados.");
        return;
    }

    // Función para cargar las notificaciones
    function loadNotifications() {
        fetch('<?= base_url('notifications/getUserNotifications'); ?>')
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
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-bell me-2"></i> ${notification.description}
                                    <span class="float-end text-muted fs-7">
                                        ${new Date(notification.notification_date).toLocaleString()}
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                            `;
                        });

                        html += `
                            <a href="<?= base_url('notifications'); ?>" class="dropdown-item dropdown-footer">
                                Ver todas las notificaciones
                            </a>
                        `;
                    } else {
                        html += `<span class="dropdown-item dropdown-header">No tienes notificaciones nuevas.</span>`;
                    }

                    notificationDropdown.innerHTML = html;
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
                    <span class="dropdown-item dropdown-header">Error al cargar notificaciones.</span>
                `;
            });
    }

    // Llamada inicial para cargar las notificaciones
    loadNotifications();

    // Intervalo para recargar las notificaciones cada 30 segundos
    setInterval(loadNotifications, 30000);
});


</script>
