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
		<!--
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
		-->
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

<!-- Notifications Modal -->
<div id="notificationModal" class="modal" style="display: none;">
	<div class="modal-content">
		<span class="close" onclick="closeModalNotifications()">&times;</span>
		<h2>Detalle de la Notificación</h2>
		<p id="modalNotificationDescription"></p>
		<small id="modalNotificationDate" class="text-muted"></small>
	</div>
</div>

<!-- Comments Modal -->
<div id="commentModal" class="modal" style="display: none;">
	<div class="modal-content">
		<span class="close" onclick="closeModalComments()">&times;</span>
		<h2>Detalle del comentario</h2>
		<p id="modalCommentDescription"></p>
		<small id="modalCommentDate" class="text-muted"></small>
	</div>
</div>

<!-- Estilo de modales -->
<style type="text/css">
.modal {
	display: none;
	position: fixed;
	z-index: 1;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	overflow: auto;
	background-color: rgba(0, 0, 0, 0.4);
}

.modal .modal-content {
	background-color: var(--surface4);
	padding: 20px;
	border: 1px solid #888;
	width: 30%;
	max-width: 350px;
	box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.modal .close-button {
	color: var(--text2);
	float: right;
	font-size: 28px;
	font-weight: bold;
}

.modal .close-button:hover,
.modal .close-button:focus {
	color: black;
	text-decoration: none;
	cursor: pointer;
}


.modal form{
	display: inline-flex;
	flex-direction: column;
}

.modal .form-group {
	display: block;
	margin-bottom: 15px;
}

.modal .form-group label {
	display: block;
	margin-bottom: 5px;
}

.modal .form-group input {
	width: 300px;
	padding: 8px;
	line-height: 1.2rem;
	box-sizing: border-box;
}

.modal .button-group {
	display: flex;
	justify-content: space-between;
}

.modal .button-group button {
	padding: 10px 20px;
	border: none;
	border-radius: 5px;
	cursor: pointer;
}

.modal .button-group button[type="submit"] {
	background-color: var(--brand);
	color: white;
}

.modal .button-group button[type="submit"]:hover {
	background-color: oklab(from var(--brand) calc(l + 0.1) a b);
	color: var(--text2);
}

.modal .button-group button[type="button"] {
	background-color: var(--btn-red);
	color: white;
}

.modal .button-group button[type="button"]:hover {
	background-color: oklab(from var(--btn-red) calc(l + 0.1) a b);
	color: var(--text2);
}
</style>

<!-- Scripts para cierre de modales -->
<script type="text/javascript">

function closeModalNotifications() {
	document.getElementById('notificationModal').style.display = 'none';
}

function closeModalComments() {
	document.getElementById('commentModal').style.display = 'none';
}
</script>