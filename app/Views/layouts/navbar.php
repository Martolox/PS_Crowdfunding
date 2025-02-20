<!-- NAVBAR -->

<section id="navbar">
<nav class="navbar">
	<!-- Left buttons -->
	<ul class="navbar-nav">
		<li><a href="<?= base_url('') ?>" class="nav-link">IMPULSA</a></li>
		<li><a href="<?= base_url('') ?>" class="nav-link"role="button">
			<i class="fa-solid fa-bars"></i>
		</a></li>
		<?php if (session()->has('userSessionName')): ?>
			<li><a href="<?= base_url('projects/list') ?>" class="nav-link">Proyectos</a></li>
			<li><a href="<?= base_url('investments/list') ?>" class="nav-link">Mis Inversiones</a></li>
			<li><a href="<?= base_url('projects/myList') ?>" class="nav-link">Mis Proyectos</a></li>
		<?php endif; ?>
	</ul>
	<!-- Right buttons -->
	<ul class="navbar-nav ms-auto">
		<form id="theme-switcher">
			
			<div class="radio-container">
				<input checked type="radio" id="dark" name="theme" value="dark" class="custom-radio">
				<label for="dark">
					<i class="unchecked fa-regular fa-moon"></i>
					<i class="checked fa-solid fa-moon"></i>
				</label>
			</div>
			
			<div class="radio-container">
				<input type="radio" id="light" name="theme" value="light" class="custom-radio">
				<label for="light">
					<i class="unchecked fa-regular fa-sun"></i>
					<i class="checked fa-solid fa-sun"></i>
				</label>
			</div>
			
			<div class="radio-container">
				<input type="radio" id="dim" name="theme" value="dim" class="custom-radio">
				<label for="dim">
					<i class="unchecked fa-regular fa-circle"></i>
					<i class="checked fa-solid fa-circle-half-stroke"></i>
				</label>
			</div>
		</form>

		<!-- Usuario -->
		<li><a href="#sidebar" class="user-profile">
			<h3 class="btn"><?= session('userSessionName') ?></h3>
		</a></li>

		<!-- Comments Dropdown Menu -->
		<li id="commentsGlobe" class="nav-item dropdown">
			<a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
				<i class="far fa-comments"></i>
				<span id="commentsCount" class="bg-danger"></span>
			</a>

			<div id="commentsDropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
				<span class="dropdown-item dropdown-header">Cargando comentarios...</span>
				<div class="dropdown-divider"></div>
			</div>
		</li>

		<!-- Notifications Dropdown Menu -->
		<li id="notificationBell" class="nav-item dropdown">
			<a class="nav-link" data-bs-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span id="notificationCount" class="navbar-badge badge bg-warning"></span>
			</a>

			<div id="notificationDropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
				<span class="dropdown-item dropdown-header">Cargando notificaciones...</span>
				<div class="dropdown-divider"></div>
			</div>
		</li>

		<!-- Logout Icon -->
 		<li><a href="<?= base_url('logout') ?>">
			<i class="fa-solid fa-arrow-right-from-bracket logout"></i>
		</a></li>
		
	</ul>
</nav>
</section>

<div id="notificationModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModalNotifications()">&times;</span>
        <h2>Detalle de la Notificación</h2>
        <p id="modalNotificationDescription"></p>
        <small id="modalNotificationDate" class="text-muted"></small>
    </div>
</div>