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

<style type="text/css">

#projects section {
	width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
    margin-right: auto;
    margin-left: auto;
}

#projects h1 {
	margin: 0;
	font-size: 1.8rem;
    font-weight: 500;
    line-height: 1.2;
}

#projects .card-container {
	box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    margin-bottom: 1rem;
	display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

#projects .card-body {
	flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

#projects .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -7.5px;
    margin-left: -7.5px;
}

#projects .col {
	position: relative;
    width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
}

#projects h3 {
	font-size: 1.75rem;
	margin-bottom: .5rem;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;
}

#projects .col2 {
	position: relative;
    width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
}

#projects .product {
	max-width: 100%;
	height: auto;
    width: 100%;
    vertical-align: middle;
    border-style: none;
}

#projects img {
	overflow-clip-margin: content-box;
    overflow: clip;
}

#projects .thumbs {
	align-items: stretch;
    display: flex;
    margin-top: 2rem;
}

#projects .prod-thumb {
	box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
    border-radius: .25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    display: flex;
    margin-right: 1rem;
    max-width: 7rem;
    padding: .5rem;
}

</style>
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

<!-- PROJECTS -->

<main id="projects">
	<section>
		<h1 class="text1">Titulo</h1>
	</section>
	<section>
		<div class="card-container">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h3>LOWA Men's Renegade GTX Mid Hiking Boots Review</h3>
						<div class="col2">
							<img class="product" src="img/jpg/prod-1.jpg">
						</div>
						<div class="col2 thumbs">
							<div class="prod-thumb">
								<img class="product" src="img/jpg/prod-1.jpg">
							</div>
							<div class="prod-thumb">
								<img class="product" src="img/jpg/prod-2.jpg">
							</div>
							<div class="prod-thumb">
								<img class="product" src="img/jpg/prod-3.jpg">
							</div>
							<div class="prod-thumb">
								<img class="product" src="img/jpg/prod-4.jpg">
							</div>
							<div class="prod-thumb">
								<img class="product" src="img/jpg/prod-5.jpg">
							</div>
						</div>
					
					</div>
					<div class="col">
					
					</div>
				</div>
				<div class="row">
					
				</div>
			</div>
		</div>
	</section>
</main>

<!-- FOOTER -->
<!--
<section  id="footer"  class="surface1">
	<p>Except as otherwise noted, the content of this page is licensed under the Creative Commons Attribution 4.0 License, and code samples are licensed under the Apache 2.0 License. For details, see the SCV Developers Site Policies. Impulsa is a registered trademark of UNRN and/or its affiliates.<br><br>
	Last updated 2024-11-01 UTC.</p>
	
</section>
-->
<!-- END -->

</body>
</html>