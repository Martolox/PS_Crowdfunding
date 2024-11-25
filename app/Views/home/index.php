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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script type="module" src="<?= base_url('js/util.js') ?>"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

<!-- NAVBAR -->

<section id="navbar">
<nav>
	<!-- Botones izquierdos -->
	<ul class="navbar-nav">
		<li><a href="<?= base_url('') ?>" class="nav-link">IMPULSA</a></li>
		<li><a href="<?= base_url('') ?>" class="nav-link"role="button">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="var(--text1)">
				<path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/>
			</svg>
		</a></li>
		<li><a href="<?= base_url('projects/list') ?>" class="nav-link">Proyectos</a></li>
		<li><a href="<?= base_url('investments/list') ?>" class="nav-link">Inversiones</a></li>
		<li><a href="<?= base_url('projects/myList') ?>" class="nav-link">Mis Proyectos</a></li>
	</ul>
	<!-- Botones derechos -->
	<ul class="navbar-nav ms-auto">
		<form id="theme-switcher">
			
			<div class="radio-container">
				<input checked type="radio" id="dark" name="theme" value="dark" class="custom-radio">
				<label for="dark">
					<!-- SVG para estado no seleccionado -->
					<svg class="unchecked"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="18" height="18" fill="var(--text2)">
						<path d="M144.7 98.7c-21 34.1-33.1 74.3-33.1 117.3c0 98 62.8 181.4 150.4 211.7c-12.4 2.8-25.3 4.3-38.6 4.3C126.6 432 48 353.3 48 256c0-68.9 39.4-128.4 96.8-157.3zm62.1-66C91.1 41.2 0 137.9 0 256C0 379.7 100 480 223.5 480c47.8 0 92-15 128.4-40.6c1.9-1.3 3.7-2.7 5.5-4c4.8-3.6 9.4-7.4 13.9-11.4c2.7-2.4 5.3-4.8 7.9-7.3c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-3.7 .6-7.4 1.2-11.1 1.6c-5 .5-10.1 .9-15.3 1c-1.2 0-2.5 0-3.7 0l-.3 0c-96.8-.2-175.2-78.9-175.2-176c0-54.8 24.9-103.7 64.1-136c1-.9 2.1-1.7 3.2-2.6c4-3.2 8.2-6.2 12.5-9c3.1-2 6.3-4 9.6-5.8c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-3.6-.3-7.1-.5-10.7-.6c-2.7-.1-5.5-.1-8.2-.1c-3.3 0-6.5 .1-9.8 .2c-2.3 .1-4.6 .2-6.9 .4z"/>
					</svg>
					<!-- SVG para estado seleccionado -->
					<svg class="checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="18" height="18" fill="var(--text1)">
						<path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/>
					</svg>
				</label>
			</div>
			
			<div class="radio-container">
				<input type="radio" id="light" name="theme" value="light" class="custom-radio">
				<label for="light">
					<!-- SVG para estado no seleccionado -->
					<svg class="unchecked"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18" height="18" fill="var(--text2)">
						<path d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/>
					</svg>
					<!-- SVG para estado seleccionado -->
					<svg class="checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18" height="18" fill="var(--text1)">
						<path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"/>
					</svg>
				</label>
			</div>
			
			<div class="radio-container">
				<input type="radio" id="dim" name="theme" value="dim" class="custom-radio">
				<label for="dim">
					<!-- SVG para estado no seleccionado -->
					<svg class="unchecked"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18" height="18" fill="var(--text2)">
						<path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
					</svg>
					<!-- SVG para estado seleccionado -->
					<svg class="checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18" height="18" fill="var(--text1)">
						<path d="M448 256c0-106-86-192-192-192l0 384c106 0 192-86 192-192zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
					</svg>
				</label>
			</div>
		</form>
		<!-- Usuario -->
		<li><a href="#sidebar" class="user-profile">
			<h3 class="btn"><?= session('userSessionName') ?></h3>
		</a></li>
		<li><a href="<?= base_url('logout') ?>">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="var(--text1)" ><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
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
			<img src="'.base_url('/uploads/'.session('userSessionProfile')).'" width="250" style="border-radius:50%">
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