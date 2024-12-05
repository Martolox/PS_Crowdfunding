<!DOCTYPE html>
<html lang="en">
<head>
	<title>Detalles del Proyecto</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#222">
	<link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
	<!-- CSS -->
	<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/dark-theme.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/detalleProyecto.css') ?>">
	<!-- JS -->
	<script type="module" src="<?= base_url('js/util.js') ?>"></script>
	<script src="https://kit.fontawesome.com/a2f79b8376.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

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

<!-- PROJECT DETAILS -->

<section id="proj-details">
<div id="projectDetails" class="bg-white rounded-lg shadow-xl p-8 m-4 max-w-xl w-full">
	<div class="inner-container">
		<h1 id="projectName" class="text-3xl font-bold mb-4 text-center text-gray-800"><?= esc($project['name']) ?></h1>
			
		<br>
		<img id="projectImage" src="<?= base_url(esc($project['img_name'])) ?>" alt="Imagen de <?= esc($project['name']) ?>" class="w-64 h-64 object-cover rounded-lg mb-6">
			
		<div class="grid grid-cols-2 gap-4 mb-6">
			<div>
				<p class="text-sm font-semibold text-gray-600">Categoría:</p>
				<p id="projectCategory" class="text-lg text-gray-800"><?= esc($project['category']) ?></p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Estado:</p>
				<p id="projectStatus" class="text-lg text-gray-800"><?= esc($project['status']) ?></p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Presupuesto:</p>
				<p id="projectBudget" class="text-lg text-gray-800"><?= number_format($project['budget'], 2, ',', '.') ?> €</p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Recaudado:</p>
				<p id="projectTotalInvestment" class="text-lg text-gray-800"><?= number_format($project['total_investment'], 2, ',', '.') ?> €</p>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-600">Fecha de finalización:</p>
				<p id="projectEndDate" class="text-lg text-gray-800"><?= date('d/m/Y', strtotime($project['end_date'])) ?></p>
			</div>
		</div>
		<div class="mb-6">
			<p class="text-sm font-semibold text-gray-600">Impacto:</p>
			<p id="projectImpact" class="text-lg text-gray-800"><?= esc($project['impact']) ?></p>
		</div>
		<div>
			<p class="text-sm font-semibold text-gray-600">Plan de recompensa:</p>
			<p id="projectRewardPlan" class="text-lg text-gray-800"><?= esc($project['reward_plan']) ?></p>
		</div>
	</div>
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