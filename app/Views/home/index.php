<?= $this->extend('layouts/default') ?>
<?= $this->section('title') ?>Impulsa : Sitio deCrowdfunding<?= $this->endSection() ?>
<?= $this->section('navbar') ?>
<!-- Navbar -->
<nav class="navbar">
	<div class="navbar-container">
		<!-- Botones izquierdos -->
		<ul class="navbar-nav">
			<li><a href="#" class="nav-link">IMPULSA</a></li>
			<li><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
			<li><a href="#" class="nav-link">Home</a></li>
			<li><a href="#" class="nav-link">Contact</a></li>
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
	</div>
</nav>
<?= $this->endSection() ?>

<?= $this->section('projects') ?>
<main>
	<section>
		<div class="surface-samples">
			<div class="surface1 rad-shadow">1</div>
			<div class="surface2 rad-shadow">2</div>
			<div class="surface3 rad-shadow">3</div>
			<div class="surface4 rad-shadow">4</div>
		</div>
	</section>

	<section>
		<div class="text-samples">
			<h1 class="text1">
				<span class="swatch brand rad-shadow"></span>
				Brand
			</h1>
			<h1 class="text1">
				<span class="swatch text1 rad-shadow"></span>
				Text Color 1
			</h1>
			<h1 class="text2">
				<span class="swatch text2 rad-shadow"></span>
				Text Color 2
		  	</h1>
			<br>
			<p class="text1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			<p class="text2">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
	</section>
</main>
<?= $this->endSection() ?>
<?= $this->section('projects2') ?>
<style type="text/css">
.projects {
	max-width: 1032px;
	margin-left: auto;
    margin-right: auto;
    margin-top: 30px;
    margin-bottom: 15px;
    box-sizing: border-box;
    display: block;
    unicode-bidi: isolate;
}

.div1 {
	box-sizing: border-box;
	margin-left: -12px;
	margin-right: -12px;
	margin-top: 30px;
}

.div2 {
	position: relative;
    min-height: 1px;
    width: 33.33333333%;
    float: left;
    padding-right: 12px;
    padding-left: 12px;
    margin-bottom: 15px;
}

.div3 {
	line-height: 1.4;
}

.image1 {
	background-image: url(https://cdn-images-1.medium.com/max/400/1*Kg4r6Yz1GU51tFkK0W4nvQ.png);
    background-position: 50% 50%;
    border: 1px solid rgba(0, 0, 0, .15);
    background-origin: border-box;
    background-size: cover;
    background-color: #f0f0f0;
    height: 172px;
    display: block;
}

.div4 {
	position: relative;
    min-height: 1px;
    box-sizing: border-box;
    padding-top: 15px;
    padding-right: 0;
    padding-left: 0;
    margin-bottom: 30px;
}

</style>

<section class="projects">
	<div class="div1">
		<div  class="div2">
			<div class="div3">
				<a class="image1"></a>
			</div>
			<div class="div4">
				<a>
					<h3>
						<div>
							The design metric evolution: from inputs to&nbsp;outcomes
						</div>
					</h3>
					<div>
						<div>
						In the world of design, where creativity meets business, metrics are the bridge that links design efforts to tangible outcomes.
						</div>
					</div>
				</a>
			<div>
				<div>
					<div>
						<a>
							<img src="https://cdn-images-1.medium.com/fit/c/36/36/1*6IeOKNurx6LmRB5TrFgCTQ.jpeg">
						</a>
					</div>
					<div>
						<a>Patrizia Bertini</a>
						<div>
							<time datetime="2024-10-26T17:24:54.487Z">Oct 26</time>
							<span class="middotDivider u-fontSize12"></span>
							<span class="readingTime" title="5 min read"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div>
		<div  class="div2">
			<div class="div3">
				<a class="image1"></a>
			</div>
			<div class="div4">
				<a href="https://uxdesign.cc/the-design-metric-evolution-from-inputs-to-outcomes-78905f75da91?source=collection_home---4------0-----------------------">
					<h3>
						<div>
							The design metric evolution: from inputs to&nbsp;outcomes
						</div>
					</h3>
					<div>
						<div>
						In the world of design, where creativity meets business, metrics are the bridge that links design efforts to tangible outcomes. Designers…
						</div>
					</div>
				</a>
			<div>
				<div>
					<div>
						<a>
							<img src="https://cdn-images-1.medium.com/fit/c/36/36/1*6IeOKNurx6LmRB5TrFgCTQ.jpeg">
						</a>
					</div>
					<div>
						<a>
							Patrizia Bertini
						</a>
						<div>
							<time datetime="2024-10-26T17:24:54.487Z">Oct 26</time>
							<span class="middotDivider u-fontSize12"></span>
							<span class="readingTime" title="5 min read"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>



<?= $this->section('projects3') ?>
<style type="text/css">

.card-container {
	box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    margin-bottom: 1rem;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;

    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.card-container {
	padding-bottom: 0
	flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

.row {
	display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -7.5px;
    margin-left: -7.5px;
}

.col {
	align-items: stretch;
	flex-direction: column;
	display: flex;
	flex: 0 0 33.333333%;
    max-width: 33.333333%;
    position: relative;
    width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
}

.card {
	color: #1f2d3d;
	background-color: #f8f9fa;
	box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    margin-bottom: 1rem;
    flex: 1 1 auto;
    display: flex;
    position: relative;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.card-header {
	background-color: transparent;
    padding: .75rem 1.25rem;
    position: relative;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #6c757d;
    border-bottom: 0;
    margin-bottom: 0;
}

.card-body {
	padding-top: 0;
	flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}

.col-7 {
	flex: 0 0 58.333333%;
    max-width: 58.333333%;
    position: relative;
    width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
}

.col-text-center {
	text-align: center;
	flex: 0 0 41.666667%;
    max-width: 41.666667%;
    position: relative;
    width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
}

.img {
	border-radius: 50%;
	max-width: 100%;
    height: auto;
    vertical-align: middle;
    border-style: none;
}

</style>


<section>
	<div class="card-container">
		<div class="card-container-body">
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header">
							MIS PROYECTOS
						</div>
						<div class="card-body surface3">
							<div class="row">
								<div class="col-7">
									<div class="col-text-center">
										<img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg">
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>