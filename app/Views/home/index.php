<?= $this->extend('layouts/default') ?>
<?= $this->section('page_title') ?>Impulsa : Sitio de Crowdfunding<?= $this->endSection() ?>

<!-- INDEX -->
<?= $this->section('content') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<!-- Banner -->
<section id="banner">
	<div class="inner">
		<h2>Bienvenidos a Impulsa!</h2>
		<p >Conectamos emprendedores visionarios con una comunidad global de inversores que buscan apoyer ideas</p>     
	</div>
</section>

<!-- Hero -->
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

<!-- Gallery -->
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
<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>