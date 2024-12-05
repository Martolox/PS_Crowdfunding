<!DOCTYPE html>
<html lang="en">
<head>
	<title>Impulsa : Sitio de Crowdfunding</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#222">
	<link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
	<!-- CSS -->
	<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/dark-theme.css') ?>">
	<!-- JS -->
	<script type="module" src="<?= base_url('js/util.js') ?>"></script>
	<script src="https://kit.fontawesome.com/a2f79b8376.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

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

<!-- BANNER -->

<section id="banner">
	<div class="inner">
		<h2>Bienvenidos a Impulsa!</h2>
		<p >Conectamos emprendedores visionarios con una comunidad global de inversores que buscan apoyer ideas</p>     
	</div>
</section>

<!-- HERO -->

<section id="hero"  class="surface2">
	<h2>
		<i>"Con <strong>IMPULSA</strong> despegan proyectos con el potencial de transformar industrias"</i>
	</h2>
	<p>Ingresa para comenzar</p>
	<ul >
		<li>
			<a href="<?= base_url() ?>register">
				<button class="rad-shadow">Registrarme</button>
			</a>
		</li>
		<li>
			<a href="<?= base_url() ?>login">
				<button class="rad-shadow">Tengo cuenta</button>
			</a>    
		</li>
	</ul>
</section>

<!-- GALLERY -->

<main id="gallery">
	<section class="gallery-container">
		<div class="container">
			<img class="rad-shadow" src="https://picsum.photos/350/200?random=1">
			<img class="rad-shadow" src="https://picsum.photos/350/200?random=2">
			<img class="rad-shadow" src="https://picsum.photos/350/200?random=3">
			<img class="rad-shadow" src="https://picsum.photos/350/200?random=4">
		</div>
	</section>

	<section>
		<div class="text">
			<h1 class="text1">
				<span class="swatch brand rad-shadow"></span>
				Interacción y Colaboración
			</h1>
			<br>
			<h1 class="text1">
				<span class="swatch text1 rad-shadow"></span>
				Análisis y Reportes
			</h1>
			<p class="text1">Paneles de control para que los emprendedores puedan monitorear el progreso de sus campañas y los inversores puedan seguir sus inversiones.</p>
			<h1 class="text2">
				<span class="swatch text2 rad-shadow"></span>
				Seguridad y Cumplimiento
			</h1>
			<p class="text2">Implementación de medidas de seguridad avanzadas para proteger los datos y las transacciones de los usuarios, cumpliendo con las normativas legales vigentes.</p>
		</div>
	</section>
</main>

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