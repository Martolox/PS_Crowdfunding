<!DOCTYPE html>
<html lang="en">
<head>
	<title>Proyectos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#222">
	<link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
	<!-- CSS -->
	<link rel="stylesheet" href="<?= base_url('css/dark-theme.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/tables.css') ?>">
	<!-- JS -->
	<script src="https://kit.fontawesome.com/a2f79b8376.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="module" src="<?= base_url('js/util.js') ?>"></script>
	<script src="<?= base_url('js/modalCrearInversion.js') ?>"></script>
	<script src="<?= base_url('js/modalDetallesProyecto.js') ?>"></script>
	<script src="<?= base_url('js/alertasYMensajesProjets.js') ?>"></script>
</head>
<body>

<!-- ALERTAS -->

<?php if (session()->getFlashdata('message') || session()->getFlashdata('error')): ?>
	<input type="hidden" id="alertMessage" value="<?= session()->getFlashdata('message') ?>">
	<input type="hidden" id="alertError" value="<?= session()->getFlashdata('error') ?>">
<?php endif; ?>

<!-- NAVBAR -->

<section id="navbar">
<nav>
	<!-- Left buttons -->
	<ul class="navbar-nav">
		<li><a href="<?= base_url('') ?>" class="nav-link">IMPULSA</a></li>
		<li><a href="<?= base_url('') ?>" class="nav-link"role="button">
			<i class="fa-solid fa-bars"></i>
		</a></li>
		<?php if (session()->has('userSessionName')): ?>
			<li><a href="<?= base_url('projects/list') ?>" class="nav-link">Proyectos</a></li>
			<li><a href="<?= base_url('investments/list') ?>" class="nav-link">Inversiones</a></li>
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
		<li><a href="<?= base_url('logout') ?>">
			<i class="fa-solid fa-arrow-right-from-bracket"></i>
		</a></li>
	</ul>
</nav>
</section>

<!-- MENSAJES -->

<?php if (session()->has('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session('success') ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= session('error') ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>  

<!-- SIDEBAR -->

<nav id="sidebar">
	<a href="#" class="close"><img src="<?= base_url('img/icons/xmark-solid.svg') ?>"></a>
	<ul class="links">
		<li><a href="<?= base_url('/') ?>">Home</a></li>
		<li><a href="<?= base_url('projects/myList') ?>">Mis Proyectos</a></li>
		<li><a href="<?= base_url('investments/list') ?>">Mis Inversiones</a></li>
	</ul>

	<?php 
	if ((session('userSessionName') !== null) && 
		(session('userSessionEmail') !== null) && 
		(session('userSessionProfile') !== null)) {
		echo '<form action="users/update" enctype="multipart/form-data" autocomplete="off" method="post">
		<br>
		<h2>Perfil</h2>
		<label for="img_name">Foto de perfil</label>
		<div class="profile-img">
			<img src="'.base_url(session('userSessionProfile')).'" width="250" style="border-radius:50%">
		</div>
		<input type="file" id="img_name" name="img_name" accept="image/*" class="hidden">
		
		<label for="username">Tu nombre</label>
		<input type="text" id="username" name="username" placeholder="'.session('userSessionName').'" value="">
		
		<label for="email">Tu Email</label>
		<input type="email" id="email" name="email" placeholder="'.session('userSessionEmail').'" value="">
		
		<br>
		<input type="submit" name="submit" value="Guardar cambios">
		<br>
		<br>
	</form>';
	}
	?>
</nav>

<!-- PROJECTS SEARCH -->

<section id="proj-search">
	<h3>Proyectos para Invertir</h3>
	<div class="search-container">
		<input type="text" id="searchInput" placeholder="Buscar proyectos...">
		<button onclick="
			if (document.getElementById('searchInput').value.trim() !== '') { window.location.href='<?= base_url('projects/filter/') ?>' + document.getElementById('searchInput').value; } 
			else { alert('Por favor, ingrese un término de búsqueda.'); }">
				<i class="fa-solid fa-magnifying-glass"></i>
		</button>
		<button class="reset-button" onclick="window.location.href='<?= base_url('projects/list') ?>'">
			<i class="fa-solid fa-arrow-rotate-right"></i>
		</button>
	</div>
</section>

<!-- PROJECTS TABLE -->

<section id="tbl-container">
<table id="proj-table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Categoria</th>
			<th>Impacto</th>
			<th>Estado</th>
			<th>Fondo</th>
			<th>Fecha Cierre</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	<?php if(isset($projects)) foreach ($projects as $p): ?>
		<tr>
			<td><?= $p['id_projects'] ?></td>
			<td><?= $p['name'] ?></td>
			<td><?= $p['category'] ?></td>
			<td><?= $p['impact'] ?></td>
			<td><?= $p['status'] ?></td>
			<td><?= $p['budget'] ?></td>
			<td><?= $p['end_date'] ?></td>
			<td>
			<div class="button-group">
				<button class="btn-action" onclick="openInvestmentModal(<?= session('userSessionID')?>, <?=$p['id_projects'] ?>)">
				<i class="fa-solid fa-pen-to-square"></i>
				Invertir
				</button>
				<button class="btn-action" onclick="location.href='<?= base_url('projects/detail/' . $p['id_projects']) ?>'">Detalles</button>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</section>

<!-- MODAL CREAR INVERSION -->

<section id="modal" class="modal">
	<div class="modal-content">
		<span class="close-button" onclick="closeModal()">&times;</span>
		<h2>Realizar inversión</h2>
		<input type="hidden" id="current_user_id" value="<?= session('userSessionID') ?>">
		<form action="<?= base_url()?>investments/create" method="post">
			<div class="form-group">
				<label for="id_username">Id usuario:</label>
				<input type="text" id="id_username" name="id_username" required readonly>
			</div>
			<div class="form-group">
				<label for="id_project">Id proyecto:</label>
				<input type="text" id="id_project" name="id_project" required readonly>
			</div>
			<div class="form-group">
				<label for="amount">Monto:</label>
				<input type="number" id="amount" name="amount" placeholder="Ingresar monto" min="1" step="1" required>
			</div>
			<div class="form-group button-group">
				<button type="submit" value="data">Aceptar</button>
				<button type="button" onclick="closeModal()">Cancelar</button>
			</div>
		</form>
	</div>
</section>

<!-- FOOTER -->

<section  id="footer"  class="surface1">
	<p>Except as otherwise noted, the content of this page is licensed under the Creative Commons Attribution 4.0 License, and code samples are licensed under the Apache 2.0 License. For details, see the SCV Developers Site Policies. Impulsa is a registered trademark of UNRN and/or its affiliates.<br><br>
	Last updated 2024-11-01 UTC.</p>
	
</section>

<!-- SCRIPTS -->

<script src="<?= base_url('js/sidebar.js') ?>"></script>

<!-- END -->

</body>
</html>