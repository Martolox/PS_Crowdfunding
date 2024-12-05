<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inversiones</title>
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
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="module" src="<?= base_url('js/util.js') ?>"></script>
	<script src="<?= base_url('js/modal_modificar.js') ?>"></script>
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

<!-- INVESTMENTS TITLE -->

<section id="proj-search">
	<h3>Inversiones</h3>
</section>

<!-- INVESTMENTS TABLE -->

<section id="tbl-container">
<table id="proj-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Invertido</th>
			<th>Fecha inversión</th>
			<th>Proyecto</th>
			<th>Fecha finalización</th>
			<th>Estado</th>
			<th>Operaciones</th>
		</tr>
	</thead>
	<?php if (session()->getFlashdata('message') || session()->getFlashdata('error')): ?>
		<input type="hidden" id="alertMessage" value="<?= session()->getFlashdata('message') ?>">
		<input type="hidden" id="alertError" value="<?= session()->getFlashdata('error') ?>">
	<?php endif; ?>

	<?php foreach ($investments_proyects as $inv_pro): ?>
		<tr>
			<td><?= $inv_pro['id_investments'] ?></td>
			<td><?= $inv_pro['amount'] ?></td>
			<td><?= $inv_pro['investment_date'] ?></td>
			<td><?= $inv_pro['project_name'] ?></td>
			<td><?= $inv_pro['project_end_date'] ?></td>
			<td><?= $inv_pro['status'] ?></td>
			<td>
			<div class="button-group">
			<?php if ($inv_pro['status'] != 'finalized'): ?>
				<a href="<?= base_url('investments/eliminarInversion/' . $inv_pro['id_investments']) ?>">
					<button class="btn-action">Cancelar</button>
				</a>
			<?php endif;?>
				<button class="btn-action" onclick="openModal(<?= $inv_pro['id_investments'] ?>, <?= $inv_pro['amount'] ?>)">Modificar</button>
				<button class="btn-action">Detalles</button>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</section>

<!-- Modal UPDATE-->

<section id="modal" class="modal">
	<div class="modal-content">
		<span class="close-button" onclick="closeModal()">&times;</span>
		<h2>Cambiar monto</h2>
		<form action="http://localhost/crowdfunding/public/investments/update" method="post">
			<div class="form-group">
				<label for="id_inversion">Id inversión</label>
				<input type="number" id="id_inversion" name="id_inversion" placeholder="Enter id" required readonly>
			</div>
			<div class="form-group">
				<label for="monto_viejo">Invertido</label>
				<input type="number" id="monto_viejo" name="monto_viejo" placeholder="Enter amount" min="1" step="1" required readonly>
			</div>
			<div class="form-group">
				<label for="monto_nuevo">Nuevo monto</label>
				<input type="number" id="monto_nuevo" name="monto_nuevo" placeholder="Enter new amount" min="1" step="1" required>
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