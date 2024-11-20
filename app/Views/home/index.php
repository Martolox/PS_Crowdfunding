<!DOCTYPE html>
<html lang="es">
<head>
    <title>Impulsa : Sitio de Crowdfunding</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#222">
    <!-- Bootstrap CSS -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/ico" href="img/favicon.ico"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" 
          integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" 
          crossorigin="anonymous">


		  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

			<style>
			.modal-dialog {
				max-width: 600px;
				width: 100%;
			}

			.modal-content {
				padding: 15px;
			}

			.form-control {
				width: 100%;
			}
			</style>

    <script type="module" src="js/util.js"></script>
</head>
<body>

<!-- NAVBAR -->
<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Botones izquierdos -->
    <ul class="navbar-nav">
        <li class="nav-item"><a href="<?= base_url() ?>" class="nav-link">IMPULSA</a></li>
        <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
        <li class="nav-item"><a href="projects/list" class="nav-link">Proyectos</a></li>
        <li><a href="investments/list" class="nav-link">Inversiones</a></li>
        <li class="nav-item"><a href="projects/myList" class="nav-link">Mis Proyectos</a></li>
    </ul>
    <!-- Botones derechos -->
    <ul class="navbar-nav ml-auto">
        <form id="theme-switcher" class="form-inline">
            <div class="form-check form-check-inline">
                <input checked type="radio" id="dark" name="theme" value="dark" class="form-check-input">
                <label for="dark" class="form-check-label">Dark</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="light" name="theme" value="light" class="form-check-input">
                <label for="light" class="form-check-label">Light</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="dim" name="theme" value="dim" class="form-check-input">
                <label for="dim" class="form-check-label">Dim</label>
            </div>
        </form>
        <!-- Barra de búsqueda -->
        <!-- Usuario -->
        <li><h3><?= session('userSessionName') ?></h3></li>
        <li><a href="<?= base_url('logout') ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="var(--text1)" ><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
        </a></li>
    </ul>
</nav>
</section>

<!-- BANNER -->
<section id="banner">
    <div class="inner">
        <h2>Bienvenidos a Impulsa!</h2>
        <p>Conectamos emprendedores visionarios con una comunidad global de inversores que buscan apoyar ideas</p>        
    </div>
</section>

<!-- HERO -->
<section id="hero" class="surface2">
    <h2>
        <i>"Con <strong>IMPULSA</strong> despegan proyectos con el potencial de transformar industrias"</i>
    </h2>
    <p>Ingresa para comenzar</p>
    <ul>
        <li>
            <a href="register">
                <button class="btn rad-shadow">Registrarme</button>
            </a>
        </li>
        <li>
            <a href="login">
                <button class="btn rad-shadow">Tengo cuenta</button>
            </a>  
        </li>
    </ul>
</section>

<!-- GALLERY -->

<main id="gallery">
    <section>
        <div class="container">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=1" alt="Imagen 1">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=2" alt="Imagen 2">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=3" alt="Imagen 3">
            <img class="rad-shadow" src="https://picsum.photos/350/200?random=4" alt="Imagen 4">
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
<section id="footer" class="surface1">
    <p>Except as otherwise noted, the content of this page is licensed under the Creative Commons Attribution 4.0 License, and code samples are licensed under the Apache 2.0 License. For details, see the SCV Developers Site Policies. Impulsa es una marca registrada de UNRN y/o sus afiliados.<br><br>
    Last updated 2024-11-01 UTC.</p>
</section>


<!-- Scripts de Bootstrap y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>


		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>
