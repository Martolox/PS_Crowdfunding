<!DOCTYPE html>
<html lang="en">
<head>
	<title>Impulsa : Sitio de Crowdfunding</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#222">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="icon" type="image/ico" href="img/favicon.ico"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" crossorigin="anonymous">
	<script type="module" src="js/util.js"></script>
</head>
<body>

<!-- NAVBAR -->

<section id="navbar">
<nav>
	<!-- Botones izquierdos -->
	<ul class="navbar-nav">
		<li><a href="#" class="nav-link">IMPULSA</a></li>
		<li><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
		<li><a href="#" class="nav-link">Proyectos</a></li>
		<li><a href="#" class="nav-link">Inversiones</a></li>
		<li><a href="#" class="nav-link">Mis Proyectos</a></li>
	</ul>
	<!-- Botones derechos -->
	<ul class="navbar-nav ms-auto">
		<form id="theme-switcher">
			<div>
				<input checked type="radio" id="dark" name="theme" value="dark">
				<label for="dark">Dark</label>
			</div>
			<div>
				<input type="radio" id="light" name="theme" value="light">
				<label for="light">Light</label>
			</div>
			<div>
				<input type="radio" id="dim" name="theme" value="dim">
				<label for="dim">Dim</label>
			</div>
		</form>
		<!-- Barra de búsqueda -->
		<li> <a class="nav-link" href="#" role="button"><i class="fas fa-search"></i></a></li>
	</ul>
</nav>
</section>

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
			<a href="register">
				<button class="rad-shadow">Registrarme</button>
			</a>
		</li>
		<li>
			<a href="login">
				<button class="rad-shadow">Tengo cuenta</button>
			</a>	
		</li>
	</ul>
</section>

<!-- GALLERY -->

<main id="gallery">
	<section>
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

<!-- END -->

</body>
</html>