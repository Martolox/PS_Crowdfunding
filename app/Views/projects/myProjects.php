<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mis Proyectos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#222">
	<link rel="icon" type="image/ico" href="<?= base_url('img/favicon.ico') ?>"/>
	<!-- CSS -->
	<!--
	<link rel="stylesheet" href="<?= base_url('css/dark-theme.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
	<link rel="stylesheet" href="<?= base_url('css/tables.css') ?>"> -->

	<link rel="stylesheet" href="/crowdfunding/public/css/crearProyecto.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script type="module" src="<?= base_url('js/util.js') ?>"></script>
	<script src="<?= base_url('js/modalCrearProyecto.js') ?>"></script>
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
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="var(--text1)">
				<path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/>
			</svg>
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
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="var(--text1)"><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
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
	<h3>Mis Proyectos</h3>
	<div class="search-container">
		<input type="text" id="searchInput" placeholder="Buscar proyectos...">
		<button onclick="
			if (document.getElementById('searchInput').value.trim() !== '') { window.location.href='<?= base_url('projects/filterMylist/') ?>' + document.getElementById('searchInput').value; } 
			else { alert('Por favor, ingrese un término de búsqueda.'); }">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
		</button>
		<button class="reset-button" onclick="window.location.href='<?= base_url('projects/projects/myList') ?>'">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M463.5 224l8.5 0c13.3 0 24-10.7 24-24l0-128c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8l119.5 0z"/></svg>
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
	<?php foreach ($projects as $project): ?>
		<tr>
			<td><?= $project['id_projects'] ?></td>
			<td><?= $project['name'] ?></td>
			<td><?= $project['category'] ?></td>
			<td><?= $project['impact'] ?></td>
			<td><?= $project['status'] ?></td>
			<td><?= $project['budget'] ?></td>
			<td><?= $project['end_date'] ?></td>
			<td><div class="button-group">			   
				<?php if ($project['status'] == 'EN PROCESO'): ?>
					<!-- Botón para activar el proyecto -->
					<a href="<?= base_url('ProjectsController/changeStatus/' . $project['id_projects'] . '/PUBLICADO') ?>" class="btn btn-warning btn-sm">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16" fill="var(--text1)"><path d="M384 128c70.7 0 128 57.3 128 128s-57.3 128-128 128l-192 0c-70.7 0-128-57.3-128-128s57.3-128 128-128l192 0zM576 256c0-106-86-192-192-192L192 64C86 64 0 150 0 256S86 448 192 448l192 0c106 0 192-86 192-192zM192 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z"/></svg>Publicar
					</a>			   
					<!-- Botón de edición -->
					<button onclick="editProject(<?= $project['id_projects'] ?>)" class="btn btn-primary btn-sm">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg>Editar
					</button>
				<?php elseif ($project['status'] == 'PUBLICADO'): ?>
					<!-- Botón para cancelar el proyecto -->
					<button  onclick="showCancelModal(<?= $project['id_projects']; ?>, '<?= addslashes($project['name']); ?>', '<?= base_url('projectsController/cancel_project/' . $project['id_projects']); ?>')" 
								class="btn btn-danger btn-sm">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>Cancelar
					</button>
						   
					<button onclick="editProject(<?= $project['id_projects'] ?>)" class="btn btn-primary btn-sm">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg>Editar
					</button>
					 <!-- Botón para finalizar si end_date <= hoy -->
					<?php if (strtotime($project['end_date']) <= strtotime(date('Y-m-d'))): ?>
						<a href="<?= base_url('projectsController/final_project/' . $project['id_projects'] ) ?>" class="btn btn-success btn-sm">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>Finalizar
						</a>
					<?php endif; ?>
				<?php elseif ($project['status'] == 'CANCELADO'): ?>
				<!-- Proyecto cancelado - sin acciones adicionales -->
				<span class="badge badge-danger">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>Proyecto Cancelado
					</span>
				<?php elseif ($project['status'] == 'FINALIZADO'): ?>
				<!-- Proyecto finalizado - sin acciones adicionales -->
				<span class="badge badge-success">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="var(--text1)"><path d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0L133.9 0c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0L487.4 0C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z"/></svg>Proyecto Finalizado
				</span>
				<?php endif; ?>
			</div></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</section>


<button onclick="openProjectModal()" class="btn btn-primary create-project-btn" width="16" height="16" fill="var(--text1)">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>Crear Proyecto
</button>

<!-- MODAL CREAR PROYECTO -->

<section id="projectModal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<h2 id="modalTitle">Proyecto</h2>
		<form action="<?= base_url('ProjectsController/save_project') ?>" method="post" enctype="multipart/form-data" id="formModalProject">
			<input type="hidden" name="project_id" id="project_id">
				
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" id="name" name="name" required>
			</div>

			<div class="form-group">
				<label for="category">Categoría</label>
				<select id="category" name="category">
					<option value="TECNOLOGIA">Tecnología</option>
					<option value="PETROLEO">Petróleo</option>
					<option value="INMOBILIARIO">Inmobiliario</option>
					<option value="OTROS">Otros</option>
				</select>
			</div>

			<div class="form-group">
				<label for="impact">Impacto</label>
				<select id="impact" name="impact">
					<option value="ALTO">Alto</option>
					<option value="MEDIO">Medio</option>
					<option value="BAJO">Bajo</option>
				</select>
			</div>

			<div class="form-group">
				<label for="budget">Presupuesto</label>
				<input type="number" id="budget" name="budget" required>
			</div>

			<div class="form-group">
				<label for="status">Estado</label>
				<select id="status" name="status">
					<option value="EN PROCESO">En Proceso</option>
					<option value="PUBLICADO">Publicado</option>
				</select>
			</div>

			<div class="form-group">
				<label for="end_date">Fecha de Fin</label>
				<input type="date" id="end_date" name="end_date" required>
			</div>

			<div class="form-group">
				<label for="reward_plan">Plan de Recompensas</label>
				<textarea id="reward_plan" name="reward_plan" rows="3"></textarea>
			</div>

			<div class="form-group">
				<label for="project_image">Imagen del Proyecto</label>
				<!-- Imagen previa del proyecto -->
				<img 
					id="projectImage" 
					src="" 
					alt="Imagen del proyecto" 
					class="w-64 h-64 object-cover rounded-lg mb-6" 
					hidden=true> <!-- Ocultar por defecto -->
				<!-- Input para subir nueva imagen -->
				<input type="file" id="project_image" name="project_image" accept="image/*">
			</div>

			<div class="form-actions">
				<button type="button" onclick="closeProjectModal()" class="btn btn-secondary">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</form>
	</div>
</section>

<!-- MODAL CANCELAR PROYECTO -->

<div id="cancelModal" class="modal">
	<div class="modal-content">
		<h2>Confirmar Cancelación</h2>
		<p id="modal-text">¿Estás seguro de que deseas cancelar este proyecto?</p>
		<div class="modal-buttons">
			<button id='confirmButton' onclick="confirmCancel()">Confirmar</button>
			<button onclick="closeModal()">Cancelar</button>
		</div>
	</div>
</div>

<form id="cancelForm"  method="POST" style="display:none;">
	<input type="hidden" name="id_project" id="cancelProjectId">
</form>
										 
<!-- SCRIPTS -->

<script>
function showCancelModal(id, name, url) {
	// Mostrar el modal
	document.getElementById('cancelModal').style.display = 'block';
	// Cambiar el texto del modal
	document.getElementById('modal-text').textContent = `¿Estás seguro de que deseas cancelar el proyecto "${name}"?`;
    // Asignar la acción del formulario con la URL correcta
	document.getElementById('cancelForm').action = url;
	// Guardar el ID del proyecto en un campo oculto
	document.getElementById('cancelProjectId').value = id;
}

function closeModal() {
	// Ocultar el modal
	document.getElementById('cancelModal').style.display = 'none';
}

function confirmCancel() {
	// Enviar el formulario para cancelar el proyecto
	document.getElementById('cancelForm').submit();
}

function editProject(projectId) {
	// Realizar una petición AJAX para obtener los datos del proyecto
	fetch(`<?= base_url('projectsController/getProject/') ?>${projectId}`)
		.then(response => response.json())
		.then(data => {
			// Cargar los datos al formulario del modal
		   // Mostrar el modal
		   openProjectModal();
			document.getElementById('modalTitle').innerText = 'Editar Proyecto';
			document.getElementById('project_id').value = data.id_projects;
			document.getElementById('name').value = data.name;
			document.getElementById('category').value = data.category;
			document.getElementById('impact').value = data.impact;
			document.getElementById('budget').value = data.budget;
			document.getElementById('status').value = data.status;
			document.getElementById('end_date').value = data.end_date;
			document.getElementById('reward_plan').value = data.reward_plan;
			// Configurar la imagen del proyecto
			const projectImageElement = document.getElementById('projectImage');
			if (data.img_name && data.img_name.trim() !== '') {
				projectImageElement.src = `<?= base_url('/') ?>${data.img_name}`;
				projectImageElement.hidden = false; // Mostrar la imagen
			} else {
				projectImageElement.hidden = true; // Ocultar si no hay imagen
			}	
		})
		.catch(error => console.error('Error al cargar los datos del proyecto:', error));
}
</script>
<script src="<?= base_url('js/sidebar.js') ?>"></script>

<!-- END -->

</body>
</html>